<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/11/27
 * Time: 23:34
 */

namespace app\admin\controller;


use app\model\AdminModel;

use app\model\ArticleModel;
use app\model\UserBuyModel;
use app\tkcms\AdminBase;
use think\Request;
use app\common\BaseConst;
use think\Db;

class Article extends AdminBase
{
    public $adminModel;
    public $articleModel;


    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->adminModel = new AdminModel();
        $this->articleModel = new ArticleModel();

    }

    /**后台用户列表
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function articleList(Request $request)
    {
        if ($request->isPost()) {
            $name = trim($request->param('title'));
            $where['title'] = ['like', "%$name%"];
        }
        $where['delete_time'] = 0;
        //  var_dump($where);die;
        $articleList = $this->articleModel->where($where)->order('create_time desc')->paginate(15, false, ['query' => request()->param()]);
        return $this->fetch("admin@article/article_list", ['articleList' => $articleList]);
    }

    /**添加后台用户
     * @param Request $request
     * @return mixed|\think\response\Json
     */
    public function articleAdd(Request $request)
    {
        if ($request->isPost()) {
            $name = trim($request->post('title'));

            $status = $request->post('status');
            $introduction = trim($request->post('introduction'));
            $content = trim($request->post('content'));
//            if ($file) {
//
//                $info = $file->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'image');
//
//                if ($info) {
//                    $saveName = $info->getSaveName();
//                    if (!in_array(explode('.', $saveName)[1], ['jpg', 'jpeg', 'png'])) {
//                        return tkJson(BaseConst::ERROR, '文件格式只支持jpg,jpeg,png');
//                    }
//                    $arr = explode("\\", $saveName);
//                    $str = implode('/', $arr);
//                    $url = '/upload/image/' . $str;
//                } else {
//                    return tkJson(BaseConst::ERROR, '文件上传失败');
//                }
//            } else {
//                return tkJson(BaseConst::ERROR, '请上传logo');
//            }
            if (empty($name)) {
                return tkJson(BaseConst::ERROR, '请输入文章名称');
            }

            if (empty($introduction)) {
                return tkJson(BaseConst::ERROR, '请输入文章简介');
            }
            if (empty($content)) {
                return tkJson(BaseConst::ERROR, '请输入文章内容');
            }

            if ($this->articleModel->field('title')->where(['title' => $name, 'delete_time' => 0])->find()) {
                return tkJson(BaseConst::ERROR, '文章名称已存在');
            }
            $res = $this->articleModel->insert(
                [
                    'title' => $name,
                    'introduction' => $introduction,
                    'content' => $content,
                    'status' => $status ? $status : 0,
                    'create_time' => time(),

                ]
            );
            if ($res) {
                return tkJson(BaseConst::SUCCESS, '添加成功');
            } else {
                return tkJson(BaseConst::ERROR, '添加失败');
            }
        }
        return $this->fetch('admin@article/article_add');
    }

    /**修改后台文章
     * @param Request $request
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function articleEdit(Request $request)
    {
        $articleId = $request->get('id');
        if ($request->isPost()) {
            $articleId = $request->post('id');
            $name = trim($request->post('title'));
            $status = $request->post('status');
            $introduction = trim($request->post('introduction'));
            $content = trim($request->post('content'));

//            if ($file) {
//                $info = $file->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'image');
//                if ($info) {
//                    $saveName = $info->getSaveName();
//                    if (!in_array(explode('.', $saveName)[1], ['jpg', 'jpeg', 'png'])) {
//                        return tkJson(BaseConst::ERROR, '文件格式只支持jpg,jpeg,png');
//                    }
//                    $arr = explode("\\", $saveName);
//                    $str = implode('/', $arr);
//                    $url = '/upload/image/' . $str;
//                } else {
//                    return tkJson(BaseConst::ERROR, '文件上传失败');
//                }
//            }
            if (empty($name)) {
                return tkJson(BaseConst::ERROR, '请输入文章名称');
            }
            if (empty($introduction)) {
                return tkJson(BaseConst::ERROR, '请输入文章简介');
            }
            if (empty($content)) {
                return tkJson(BaseConst::ERROR, '请输入文章内容');
            }

            $data = [
                'title' => $name,
                'introduction' => $introduction,
                'content' => $content,
                'status' => $status ?: 1,
                'create_time' => time(),

            ];
            if ($this->articleModel->field('title')->where(['title' => $name, 'id' => ['<>', $articleId]])->find()) {
                return tkJson(BaseConst::ERROR, '文章名称已存在');
            }
            $res = $this->articleModel->updateData($data, ['id' => $articleId]);
            if ($res) {
                return tkJson(BaseConst::SUCCESS, '修改成功');
            } else {
                return tkJson(BaseConst::ERROR, '修改失败');
            }
        }
        $articleInfo = $this->articleModel->where(['id' => $articleId])->find();
        return $this->fetch('admin@article/article_edit', ['articleInfo' => $articleInfo]);
    }

    /**删除文章
     * @param Request $request
     * @return \think\response\Json
     */
    public function articleDel(Request $request)
    {
        $articleId = $request->post('id');
        $res = $this->articleModel->updateData(['delete_time' => time()], ['id' => $articleId]);
        if ($res) {
            return tkJson(BaseConst::SUCCESS, '删除成功');
        } else {
            return tkJson(BaseConst::ERROR, '删除失败');
        }
    }
}