<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * JSON封装
 * @param int $code
 * @param string $msg
 * @param array $data
 * @param int $count
 * @return \think\response\Json
 */
function tkJson($code = 10000, $msg = '操作成功', $data = [], $count = 0)
{
    !$count && $count = 0;
    return json(['code' => $code, 'data' => $data, 'count' => $count, 'msg' => $msg, 'time' => time()]);
}

/**
 * 输出模板的时候判断下
 * @param $variable
 * @return string
 */
function tkIsset($variable)
{
    return isset($variable) ? $variable : '';
}

/**
 * 获取栏目下的新闻
 * @param $categoryId
 * @param array $where
 * @param null $order
 * @param null $limit
 * @param null $cacheNo
 * @param $pageNum
 * @return array|mixed
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 */
function get_article_list_by_category_ids($categoryId, $where = [], $order = null, $limit = null, $cacheNo = null, $pageNum = 10)
{
    $cacheList = \app\cache\DataCache::getNewsList($cacheNo);
    if ($cacheNo && $cacheList) {
        return $cacheList;
    }
    $categoryModel = new \app\model\CategoryModel();
    if (!is_numeric($categoryId) && !is_array($categoryId)) {
        $_categoryInfo = $categoryModel->getOne(['url_name' => $categoryId]);
        $categoryId = (array)$_categoryInfo->id;
    } else {
        if (!is_array($categoryId)) {
            $categoryId = (array)$categoryId;
        }
    }
    $fields = ['uri', 'tag', 'thumb', 'desc', 'ctime', 'images', 'member_id', 'title', 'author', 'views'];
    $_where = ['category_id' => $categoryId];
    if (!empty($where)) {
        $_where = array_merge($_where, (array)$where);
    }

    $articleModel = new \app\model\ArticleModel();
    $articleList = $articleModel->getList($fields, $_where, $order, null, $limit, $pageNum);
    foreach ($articleList as &$item) {
        $item['images'] = json_decode($item['images']);
        $item['url'] = \think\Url::build('pc/Article/articleDetail', "uri=" . $item['uri']);
        $item['mb_url'] = \think\Url::build('wap/Article/articleDetail', "uri=" . $item['uri']);
    }
    if ($cacheNo && $articleList) {
        \app\cache\DataCache::setNews($categoryId, $articleList);
    }
    return $articleList;
}

/**
 * 获取二级菜单
 * @param $categoryId
 * @return array
 */
function get_child_menu($categoryId)
{
    if (!(int)$categoryId) {
        return [];
    }
    $categoryModel = new \app\model\CategoryModel();
    $list = $categoryModel->getList(['id', 'url_name', 'name'], ['parent_id' => (int)$categoryId]);
    foreach ($list as &$item) {
        //开启路由
        //todo
        if (1) {
            $item['url'] = '/' . $item['url_name'];
        } else {
            $item['url'] = url('Article/Index', 'categoryId=' . $item['id']);
        }
    }
    return $list;
}

/**
 * uri 生成
 * @return string
 */
function uri()
{
    return strtoupper(md5(uniqid(rand(), true))); //根据当前时间（微秒计）生成唯一id.
}

/**无限极分类
 * @param $array
 * @param int $pid
 * @param int $level
 * @return array
 */
function getTree($data, $pId)
{
    $tree = [];
    foreach ($data as $k => $v) {
        if ($v->pid == $pId) { //父亲找到儿子
            $v->children = getTree($data, $v->m_id);
            $tree[] = $v;
            //unset($data[$k]);
        }
    }
    return $tree;
}

/**
 * 菜单分级
 * @param $param
 * @param int $pid
 * @param int $lvl
 * @return array
 */

function selectTree($param, $pid = 0, $lvl = 0)
{
    static $res = [];
    foreach ($param as $key => $vo) {
        if ($pid == $vo->pid) {
            $vo->m_name = str_repeat('|—', $lvl) . ' ' . $vo->m_name;
            $res[] = $vo;
            $temp = $lvl + 1;
            selectTree($param, $vo->m_id, $temp);
        }
    }
    return $res;
}


function getCurl($url, $timeout = 1, $refer = '')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    //连接时间
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    //返回响应时间
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

    if ($refer) {
        curl_setopt($ch, CURLOPT_REFERER, $refer); //构造来路
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
    }

    $result = curl_exec($ch);

//    $errorCode = curl_errno($ch);
//    if (curl_errno($ch) > 0) {
//        WriteLog::write('getPageSimple', 'error_info', $url . "->" . $errorCode);
//    }
    curl_close($ch);
    return $result;
}