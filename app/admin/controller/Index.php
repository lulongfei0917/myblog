<?php
namespace app\admin\controller;

use app\common\BaseConst;
use app\model\AdminRoleModel;
use app\model\AdminModel;

use app\tkcms\AdminBase;
use think\Controller;
use think\Request;
use think\Session;


class Index extends AdminBase
{
    public $adminModel;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->adminModel = new AdminModel();

    }

    public function index()
    {

      $admin = $this->mermber;
        return $this->fetch('admin@index/index', ['admin' => $admin]);
    }

    public function login(Request $request)
    {
        if ($request->isPost()) {
            $username = $request->post('username');
            $password = $request->post('password');
            $verifyCode = $request->post('verifyCode');
            if(!captcha_check($verifyCode)){
                //验证失败
                return tkJson(BaseConst::ERROR, '验证码错误!');
            };

            if (empty($username) || empty($password)) {
                return tkJson(BaseConst::ERROR, '账号/密码错误');
            }
            $member = (new AdminModel())->get(['username' => $username, 'password' => md5($password)]);
            if ($member) {
                if ($member['status'] == 1) {
                    return tkJson(BaseConst::ERROR, '账号被禁用');
                }elseif ($member['type'] > 2){
                    return tkJson(BaseConst::ERROR, '普通用户不能登录后台');
                } else {
                    if($member->type==1){
                        Session::set('admin', [
                            'adminId' => $member['a_id'],
                            'username' => $member['username'],
                            'nickname' => $member['name'],
                            'status' => $member['status'],
                            'type'=>$member['type'],
                            'd_id'=>$member['d_id']?:0,

                        ]);
                    }else{
                        $adminRoleMenu = (new AdminRoleModel())->where(['a_id'=>$member->a_id])->field('m_id')->find();
                        Session::set('admin', [
                            'adminId' => $member['a_id'],
                            'username' => $member['username'],
                            'nickname' => $member['name'],
                            'status' => $member['status'],
                            'type'=>$member['type'],
                            'd_id'=>$member['d_id'],
                            'roleMenuId'=>explode(',',$adminRoleMenu->m_id)
                        ]);
                    }


                    return tkJson(BaseConst::SUCCESS, '登录成功');
                }
            } else {
                return tkJson(BaseConst::ERROR, '账号/密码错误');
            }
        }
        return $this->fetch('admin@index/login', ['ttt' => '你哈']);
    }

    public function loginOut()
    {
        Session::delete('admin');
        header('Location:/admin/index/login');
    }


    public function welcome()
    {
        $adminInfo = $this->adminModel->where(['a_id'=>$this->mermber['adminId']])->field('name,login_ip')->find();
          return $this->fetch('admin@index/welcome', ['adminInfo'=>$adminInfo,]);

    }

public function start()
{
    header('Location:/admin/index/index');
}

}
