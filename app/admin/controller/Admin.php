<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/11/27
 * Time: 23:34
 */
namespace app\admin\controller;

use app\model\AdminModel;
use app\model\AdminRoleModel;
use app\model\ConfigNumModel;
use app\model\DepartmentModel;
use app\model\MenuModel;
use app\tkcms\AdminBase;
use think\Request;
use app\common\BaseConst;
use think\Session;

class Admin extends AdminBase
{
    private $adminModel;
    public $departmentModel;
    public $menuModel;
    public $adminRoleModel;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->adminModel = new AdminModel();
        $this->departmentModel = new DepartmentModel();
        $this->menuModel = new MenuModel();
        $this->adminRoleModel = new AdminRoleModel();
    }

    /**后台用户列表
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function adminList(Request $request)
    {
        if($request->isPost()){
            $name = trim($request->param('name'));
            $where['name'] = ['like',"%$name%"];
        }
        $where['status']= 0;
      //  var_dump($where);die;
        $adminList = $this->adminModel->where($where)->field('a_id,name,ctime,login_ip,username,d_id,type')->order('ctime desc')->paginate(15,false,['query' => request()->param()]);
        //dump($adminList);die;
        return $this->fetch("admin@admin/admin_list",['adminList'=>$adminList]);
    }

    /**添加后台用户
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function adminAdd(Request $request)
    {
        if ($request->isPost()) {

            $name = trim($request->post('name'));
            $dId = $request->post('d_id');
            $password = $request->post('password');
            $username = trim($request->post('username'));
            $sex = $request->post('sex');
            $type = $request->post('type');
            if(empty($dId)){
                return tkJson(BaseConst::ERROR,'请选择部门');
            }
            if(empty($name)){
                return tkJson(BaseConst::ERROR,'请输入用户名,切都是汉字');
            }

            if(empty($username)){
                return tkJson(BaseConst::ERROR,'请输入登录账号');
            }
            if($this->adminModel->where(['username'=>$username])->find()){
                return tkJson(BaseConst::ERROR,'此登录账号已被占用');
            }
            if(!preg_match('/^[A-Za-z0-9]{4,16}$/',$username)){
                return tkJson(BaseConst::ERROR,'账号必须以字母数字组成，切长度4-16个字符');
            }
            if(empty($password)){
                $password = '123456';
            }
            if(empty($sex)){
                return tkJson(BaseConst::ERROR,'请选择性别');
            }
            if(empty($type)){
                return tkJson(BaseConst::ERROR,'请选择用户类型');
            }

            $status = 0;
           $res= $this->adminModel->insert(
                ['name' => $name,
                    'status' => $status,
                    'sex' => $sex,
                    'd_id'=>$dId,
                    'username' => $username,
                    'password' => md5($password),
                    'type'=>$type,
                    'ctime' => time(),
                    'login_ip' => $request->ip()]
            );
            if($res){
                return tkJson(BaseConst::SUCCESS,'添加成功');
            }else{
                return tkJson(BaseConst::ERROR,'添加失败');
            }
        }
        $departmentList = $this->departmentModel->where('delete_time =0')->field('d_id,d_name')->select();

        return $this->fetch('admin@admin/admin_add',['departmentList'=>$departmentList]);
    }

    /**修改后台用户
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function adminEdit(Request $request)
    {
        $adminId = $request->get('a_id');
        $page = $request->get('page');
        if ($request->isPost()) {
            $adminId = $request->post('a_id');
            if ($adminId ==1){
                if(empty($username)){
                    return tkJson(BaseConst::ERROR,'超级管理员不可修改');
                }
            }
            $name = $request->post('name');
            $password = $request->post('password');
            $username = $request->post('username');
            $sex = $request->post('sex');
            $type = $request->post('type');
            if(empty($name)){
                return tkJson(BaseConst::ERROR,'请输入用户名');
            }

            if(empty($username)){
                return tkJson(BaseConst::ERROR,'请输入登录账号');
            }
            if($this->adminModel->where(['username'=>$username,'a_id'=>['<>',$adminId]])->find()){
                return tkJson(BaseConst::ERROR,'此登录账号已被占用');
            }

            $info = [
                'name' => $name,
                'sex' => $sex,
                'username' => $username,
                'ctime' => time(),
                'type'=>$type
            ];
            if(!empty($password)){
                $info['password'] = md5($password);
            }

           $res =  $this->adminModel->update($info, ['a_id' => $adminId]);
            if($res){
                return tkJson(BaseConst::SUCCESS);
            }else{
                return tkJson(BaseConst::ERROR);
            }

        }
        $adminInfo = $this->adminModel->get(['a_id' => $adminId]);
        $departmentList = $this->departmentModel->where('delete_time =0')->field('d_id,d_name')->select();
        return $this->fetch('admin@admin/admin_edit', ['adminInfo' => $adminInfo,'departmentList'=>$departmentList,'page'=>$page]);
    }

    /**删除后台用户
     * @param Request $request
     * @return \think\response\Json
     */
    public function adminDel(Request $request)
    {
        $adminId = $request->post('id');
        if ($adminId == 1) {
            return tkJson(BaseConst::ERROR, '超级管理员不能删除');
        }
        $res = $this->adminModel->updateData(['status'=>1],['a_id' => $adminId]);
        if($res){
            $this->wordModel->update(['a_id'=>1,'d_id'=>6],['a_id'=>$adminId]);
        }
        if($res){
            return tkJson(BaseConst::SUCCESS,'删除成功');
        }else{
            return tkJson(BaseConst::ERROR,'删除失败');
        }
    }

    /**修改密码
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function editPassword(Request $request){
        if ($request->isPost()) {
            $name = $request->post('name');
            $possword = $request->post('password');
            if(empty($name)){
                return tkJson(BaseConst::ERROR,'请输入姓名');
            }
            $info['name'] = $name;
            if(!empty($possword)){
                if(strlen($possword)<6){
                    return tkJson(BaseConst::ERROR,'密码不得小于六位');
                }
                    $info['password'] = md5($possword);
            }


            $res = $this->adminModel->updateData($info,['a_id'=>$this->mermber['adminId']]);
            if($res){
                return tkJson(BaseConst::SUCCESS,'修改成功');
            }else{
                return tkJson(BaseConst::ERROR,'修改失败');
            }
        }
        $adminInfo = $this->adminModel->where(['a_id'=>$this->mermber['adminId']])->field('a_id,name,sex')->find();
        return $this->fetch('admin@admin/edit_password', ['adminInfo' => $adminInfo]);
    }

    /**添加权限
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function adminRole(Request $request)
    {
        $aId = $request->get('a_id');
        if($request->isPost()){
            $aId = $request->post('a_id');
            $_menuId = $request->post('menu_id/a');
            $mId = implode(',',$_menuId);
            $adminRole = $this->adminRoleModel->where(['a_id'=>$aId])->find();
            if($adminRole){
                $res = $this->adminRoleModel->update(['a_id'=>$aId,'m_id'=>$mId,'create_time'=>time()],['a_id'=>$aId]);
            }else{
                $res = $this->adminRoleModel->insert(['a_id'=>$aId,'m_id'=>$mId,'create_time'=>time()]);
            }
            if($res){
                return tkJson(BaseConst::SUCCESS,'分配成功');
            }else{
                return tkJson(BaseConst::ERROR,'分配失败');
            }

        }
        $_menuList = $this->menuModel->where(['delete_time'=>0])->select();
        $menuList = getTree($_menuList, 0);
        $_roleMenuId  = $this->adminRoleModel->field('m_id')->where(['a_id'=>$aId])->find();
        $roleMenuId = $_roleMenuId?array_values(explode(',',$_roleMenuId->m_id)):[];
      //  var_dump($roleMenuId);die;
        return $this->fetch('admin@admin/admin_role',['menuList'=>$menuList,'aId'=>$aId,'roleMenuId'=>$roleMenuId]);
    }

    /**更新参数配置
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function configList(Request $request)
    {
        if($request->isPost()){
            $zhuCe = (int)$request->post('zhu_ce');
            $tuiJian = (int)$request->post('tui_jian');
            $sheQun = (int)$request->post('she_qun');
            if(empty($zhuCe) ||empty($tuiJian) ||empty($sheQun)){
                return tkJson(BaseConst::ERROR,'参数不能为空，切为整数');
            }
          $res =   (new ConfigNumModel())->updateData(['zhu_ce'=>$zhuCe,'tui_jian'=>$tuiJian,'she_qun'=>$sheQun],['id'=>1]);
            if($res){
                return tkJson(BaseConst::SUCCESS,'更新成功');
            }else{
                return tkJson(BaseConst::ERROR,'更新失败');
            }
        }
      $config = (new ConfigNumModel())->where('id',1)->find();
        return $this->fetch('admin@admin/config_list',['config'=>$config]);

    }
}