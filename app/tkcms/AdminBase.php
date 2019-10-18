<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/11/27
 * Time: 23:36
 */

namespace app\tkcms;

use app\common\MenuConst;
use app\model\AdminRoleModel;
use app\model\MenuModel;
use think\Controller;
use think\Request;
use think\Session;
use app\common\BaseConst;

class AdminBase extends Controller
{
    public $mermber;
    public $adminRoleModel;
    public $menuModel;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->adminRoleModel = new AdminRoleModel();
        $this->menuModel  = new MenuModel();
        $this->mermber = '';
        if (!Session::get('admin')) {
            if ($request->action() !== 'login') {
                header('Location:/admin/index/login');
                exit();
            }
        } else {
            $this->mermber = Session::get('admin');
        }

        $url = $request->baseUrl();
//        var_dump($url);die;
//        var_dump($request);die;
        if(Session::get('admin.type')==2){

            if(!in_array($url,['/admin/index/welcome','/admin/index/index','/admin/admin/editPassword','/admin/index/loginOut','/admin/index/login','/admin/word/postAdmin'])){
                $m_id = $this->menuModel->where(['url'=>$url])->field('m_id')->find();
               $mId = $m_id?$m_id->m_id:'';
                if(!in_array($mId,Session::get('admin.roleMenuId'))){
                    if($request->isPost()){
                        echo json_encode(['code' => 20000, 'msg' => '抱歉，您没有权限哦！' ]);
                        exit();
                    }
                   echo "<script>alert('抱歉,您没有权限哦!');history.back()</script>";
                    exit();
                }


            }
        }


        $this->assign('menuClass', $this->getMenuClass($request->baseUrl()));
        $this->assign('memberInfo', $this->mermber);
        $this->assign('menuList', $this->getMenuList());
    }

    public function backCode()
    {
        return tkJson(BaseConst::ERROR,'没有权限');
    }
    public function getMenuList()
    {
        if(Session::get('admin.type')==2){
            $where['m_id']=['in',Session::get('admin.roleMenuId')];
        }

        $where['delete_time'] = 0;
        $_menuList = $this->menuModel->where($where)->field(['m_id', 'm_name', 'create_time', 'update_time','pid','level','url'])->select();
        $menuList  = getTree($_menuList,0);
        return $menuList;
    }

    public function getMenuClass($baseUrl)
    {
        $menuList = MenuConst::$menu;
        foreach ($menuList as $key => $item) {
            foreach ($item['list'] as $value) {
                if ($value['url'] == $baseUrl) {
                    return $key;
                }
            }
        }
        return -1;
    }


}