<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/11/27
 * Time: 23:34
 */

namespace app\admin\controller;

use app\model\MenuModel;
use app\tkcms\AdminBase;
use think\Request;
use app\common\BaseConst;

class Menu extends AdminBase
{
    public $menuModel;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->menuModel = new MenuModel();
    }

    /**目录列表
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function menuList(Request $request)
    {
        if ($request->isPost()) {
            $name = $request->param('m_name');
            $where['m_name'] = ['like', "%$name%"];
        }
        $where['delete_time'] = 0;
        $_menuList = $this->menuModel->where($where)->field(['m_id', 'm_name', 'create_time', 'update_time','pid','level','url'])->select();
        $menuList = selectTree($_menuList, 0, 0);
        return $this->fetch("admin@menu/menu_list", ['menuList' => $menuList]);
    }

    /**添加目录
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function menuAdd(Request $request)
    {
        if ($request->isPost()) {
            $name = $request->post('m_name');
            $pid = $request->post('pid');
          //  var_dump($pid);die;
            $url = $request->post('url');
            if (empty($pid)) {
                //一级菜单
                $level = 1;
                $pid = 0;
                $url = '';
            } elseif ($pid > 0) {
                if (empty($url)) {
                    return tkJson(BaseConst::ERROR, '请输入栏目地址');
                }
                $menuInfo = $this->menuModel->field('level')->where(['m_id' => $pid])->find();
                //var_dump($menuInfo);die;
                $level = $menuInfo->level + 1;
            }
            if (empty($name)) {
                return tkJson(BaseConst::ERROR, '请输入栏目名称');
            }
            $res = $this->menuModel->insert(
                [
                    'm_name' => $name,
                    'create_time' => time(),
                    'url'=>$url,
                    'pid'=>$pid,
                    'level'=>$level
                ]
            );
            if ($res) {
                return tkJson(BaseConst::SUCCESS, '添加成功');
            } else {
                return tkJson(BaseConst::ERROR, '添加失败');
            }
        }
        $_menuList = $this->menuModel->where(['delete_time'=>0])->select();
        $menuList = selectTree($_menuList, 0, 0);
        return $this->fetch('admin@menu/menu_add',['menuList'=>$menuList]);
    }

    /**修改目录
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function menuEdit(Request $request)
    {
        $menuId = $request->get('m_id');
        if ($request->isPost()) {
            $menuId = $request->post('m_id');
            $name = $request->post('m_name');
            $pid = $request->post('pid');
            $url = $request->post('url');
            if ($pid == 0) {
                //一级菜单
                $level = 1;
                $url = '';
            } elseif ($pid > 0) {
                if (empty($url)) {
                    return tkJson(BaseConst::ERROR, '请输入栏目地址');
                }
                $menuInfo = $this->menuModel->field('level')->where(['m_id' => $pid])->find();
                $level = $menuInfo->level + 1;
            }
            if (empty($name)) {
                return tkJson(BaseConst::ERROR, '请输入栏目名称');
            }
            $res = $this->menuModel->update(
                ['m_name' => $name, 'update_time' => time(), 'url'=>$url, 'pid'=>$pid, 'level'=>$level],
                ['m_id' => $menuId]
            );
            if ($res) {
                return tkJson(BaseConst::SUCCESS, '修改成功');
            } else {
                return tkJson(BaseConst::ERROR, '修改失败');
            }

        }
        $menuInfo = $this->menuModel->get(['m_id' => $menuId]);
        $_menuList = $this->menuModel->where(['delete_time'=>0])->select();
        $menuList = selectTree($_menuList, 0, 0);
        return $this->fetch('admin@menu/menu_edit', ['menuInfo' => $menuInfo,'menuList'=>$menuList]);
    }

    /**删除目录
     * @param Request $request
     * @return \think\response\Json
     */
    public function menuDel(Request $request)
    {
        $menuId = $request->post('id');
        $res = $this->menuModel->updateData(['delete_time' => time()], ['m_id' => $menuId]);
        if ($res) {
            return tkJson(BaseConst::SUCCESS, '删除成功');
        } else {
            return tkJson(BaseConst::ERROR, '删除失败');
        }
    }
}