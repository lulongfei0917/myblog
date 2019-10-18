<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/11/27
 * Time: 23:34
 */

namespace app\admin\controller;

use app\model\ConfigNumModel;
use app\model\QuotaModel;
use app\model\RecommendModel;
use app\model\UserBuyModel;
use app\model\UserModel;
use app\tkcms\AdminBase;
use think\Request;
use think\db;
use app\common\BaseConst;

class User extends AdminBase
{

    public $userModel;
    public $config;
    public $userBuyModel;
    public $quotaModel;
    public $recommendModel;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->userModel = new UserModel();
        $this->config = (new ConfigNumModel()) ->where(['id'=>1])->find();
        $this->userBuyModel = new UserBuyModel();
        $this->quotaModel = new QuotaModel();
        $this->recommendModel = new RecommendModel();

    }

    /**前台用户列表
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function userList(Request $request)
    {
        if ($request->isPost()) {

            $name = trim($request->param('telephone'));
            if($name){
                $where['telephone'] = $name;
            }

            if($request->param('start_time')){

                $startTime = strtotime($request->param('start_time'));
                $where['create_time'] = ['>=',$startTime];
            }
            if($request->param('end_time')){
                $endTime = strtotime($request->param('end_time'));
                $where['create_time'] = ['<=',$endTime];
            }

            if($request->param('s_num')){

                $s_num =(int) $request->param('s_num');
                $where['amount_money'] = ['>=',$s_num];
            }
            if($request->param('e_num')){

                $s_num =(int) $request->param('e_num');
                $where['amount_money'] = ['<=',$s_num];
            }

        }
        $where['u_id']=['<>',0];
        $_userBuyList = $this->userBuyModel->field("SUM(num) as num,u_id")->where(['status'=>1])->group('u_id')->select();
        $userBuyList = [];
        if($_userBuyList){
            foreach ($_userBuyList as $v){
                $userBuyList[$v->u_id] = $v->num;
            }
        }
        $userList = $this->userModel->where($where)->field('telephone,amount_money,create_time,u_id,status')->order('create_time desc')->paginate(15, false, ['query' => request()->param()]);
        $_userList = [];//统计推荐者使用
        foreach ($userList as $m){
            $_userList[$m->u_id] = $m->telephone;
        }
        $recommendList = $this->recommendModel->field('u_id,u_r_id')->select();
        $_recommendList = [];
        foreach ($recommendList as $item){
            $_recommendList[$item->u_r_id] = $item->u_id;
        }
        foreach ($userList as $k => $vo){
            $vo->r_tel = isset($_recommendList[$vo->u_id]) &&isset($_userList[$_recommendList[$vo->u_id]])? $_userList[$_recommendList[$vo->u_id]]:'';
            $userList[$k]->num = isset($userBuyList[$userList[$k]->u_id])?$userBuyList[$userList[$k]->u_id]:'';
            $vo->t_num = $this->recommendModel->where(['u_id'=>$vo->u_id])->count();
        }
        return view('admin@user/user_list',['userList' => $userList]);
    }

    /**用户打新额度添加
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function userEdit(Request $request)
    {

        if ($request->isPost()) {
            $userId = $request->post('id');
            if($this->quotaModel->where(['u_id' => $userId,'type'=>3])->find()){
                return tkJson(BaseConst::ERROR,'已经社群打赏，不可重复');
            }
            Db::startTrans();
            try {
                //购买记录
                $res = $this->userModel->where(['u_id' => $userId])->update(['amount_money'=>Db::raw("amount_money+".$this->config->she_qun.""),'status'=>1]);
                  $rs =  $this->quotaModel->insert(['u_id' => $userId, 'num' => $this->config->she_qun, 'type' => 3, 'create_time' => time()]);
                if ($res && $rs) {
                    Db::commit();
                    return tkJson(BaseConst::SUCCESS,'操作成功');
                } else {
                    return tkJson(BaseConst::ERROR,'操作失败');
                }
            } catch (Exception $e) {
                Db::rollback();
                return tkJson(BaseConst::ERROR,'操作失败');
            }


        }
    }


    public function userDel(Request $request)
    {
        $userId = $request->post('id');
        $res = $this->userModel->where(['u_id' => $userId])->delete();
        if ($res) {
            return tkJson(BaseConst::SUCCESS, '删除成功');
        } else {
            return tkJson(BaseConst::ERROR, '删除失败');
        }
    }

    public function userBuy(Request $request)
    {
        $userId = $request->post('id');
        $userBuyList = $this->userBuyModel->field('p_id,u_id,num,status,create_time')->where(['u_id'=>$userId])->with('project')->select();
        foreach ($userBuyList as &$v){
            if($v->status ==1 ){
                $v->status = '预约中';
            }elseif ($v->status ==2){
                $v->status = '历史预约';
            }elseif ($v->status ==3){
                $v->status = '已撤销';
            }
            $v->create_time = date('Y-m-d H:i:s',$v->create_time);
        }
        $userQuoTaList = $this->quotaModel->field('type,num,create_time')->where(['u_id'=>$userId])->select();
        foreach ($userQuoTaList as &$vo){
            if($vo->type ==1 ){
                $vo->type = '注册';
            }elseif ($vo->type ==2){
                $vo->type = '推荐';
            }elseif ($vo->type ==3){
                $vo->type = '社群';
            }
            $vo->create_time = date('Y-m-d H:i:s',$vo->create_time);
        }
        $data = ['userQuoTaList'=>$userQuoTaList,'userBuyList'=>$userBuyList];
        return tkJson(BaseConst::SUCCESS, '',$data);
    }
    public function recommendInfo(Request $request)
    {
        $userId = $request->post('id');
        $recommendList = $this->recommendModel->where(['u_id'=>$userId])->field('u_id,u_r_id,num,create_time')->with('user')->select();
        foreach ($recommendList as &$v){
            $v->create_time = date('Y-m-d H:i:s',$v->create_time);
        }
        return tkJson(BaseConst::SUCCESS, '',$recommendList);
    }
}