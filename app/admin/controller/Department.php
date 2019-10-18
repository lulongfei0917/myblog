<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/11/27
 * Time: 23:34
 */
namespace app\admin\controller;


use app\model\AdminModel;
use app\model\DepartmentModel;
use app\tkcms\AdminBase;
use think\Request;
use app\common\BaseConst;

class Department extends AdminBase
{
    private $departmentModel;
    public $adminModel;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->departmentModel = new DepartmentModel();
        $this->adminModel = new AdminModel();
    }

    /**后台用户列表
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function departmentList(Request $request)
    {
        if($request->isPost()){
            $name =trim($request->param('d_name')) ;
            $where['d_name'] = ['like',"%$name%"];
        }
        $where['delete_time']= 0;
        //  var_dump($where);die;
        $departmentList = $this->departmentModel->where($where)->field(['d_id','d_name','create_time','update_time'])->order('create_time desc')->paginate(15,false,['query' => request()->param()]);
        return $this->fetch("admin@department/department_list",['departmentList'=>$departmentList]);
    }

    /**添加后台用户
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function departmentAdd(Request $request)
    {
        if ($request->isPost()) {
            $name = trim($request->post('d_name'));
            if(empty($name)){
                return tkJson(BaseConst::ERROR,'请输入部门名称');
            }
            if($this->departmentModel->where(['d_name'=>$name,'delete_time'=>0])->find()){
                return tkJson(BaseConst::ERROR,'部门已存在');
            }
            $res= $this->departmentModel->insert(['d_name' => $name, 'create_time' => time()]);
            if($res){
                return tkJson(BaseConst::SUCCESS,'添加成功');
            }else{
                return tkJson(BaseConst::ERROR,'添加失败');
            }
        }
        return $this->fetch('admin@department/department_add');
    }

    /**修改后台用户
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function departmentEdit(Request $request)
    {
        $departmentId = $request->get('d_id');
        if ($request->isPost()) {
            $departmentId = $request->post('d_id');
            $name = trim($request->post('d_name'));
            if(empty($name)){
                return tkJson(BaseConst::ERROR,'请输入部门名称');
            }
            if($this->departmentModel->where(['d_name'=>$name,'delete_time'=>0,'d_id'=>['<>',$departmentId]])->find()){
                return tkJson(BaseConst::ERROR,'部门已存在');
            }
            $info = [
                'd_name' => $name,
                'update_time'=>time()
            ];
            $res =  $this->departmentModel->update($info, ['d_id' => $departmentId]);
            if($res){
                return tkJson(BaseConst::SUCCESS,'修改成功');
            }else{
                return tkJson(BaseConst::ERROR,'修改失败');
            }

        }
        $departmentInfo = $this->departmentModel->get(['d_id' => $departmentId]);
        return $this->fetch('admin@department/department_edit', ['departmentInfo' => $departmentInfo]);
    }

    /**删除后台部门
     * @param Request $request
     * @return \think\response\Json
     */
    public function departmentDel(Request $request)
    {
        $departmentId = $request->post('id');
        if($this->adminModel->where(['d_id'=>$departmentId,'status'=>0])->find()){
            return tkJson(BaseConst::ERROR,'该部门下有管理员账号，不可删除');
        }
        $res = $this->departmentModel->updateData(['delete_time'=>time()],['d_id' => $departmentId]);
        if($res){
            return tkJson(BaseConst::SUCCESS,'删除成功');
        }else{
            return tkJson(BaseConst::ERROR,'删除失败');
        }
    }
}