<?php
/**
 * DHCMS [ 轻量级的建站系统 BY TP5]
 * Copyright (c) 2017 - 2018. 杭州点鹤网络科技有限公司 All rights reserved.
 * Author:  http://cms.dianhetech.com/ <1010386234@qq.com>
 */

namespace app\model;

use app\tkcms\ModelBase;

class AdminModel extends ModelBase
{

    protected $name = 'admin';

    public function getAdminList($where, $page, $limit)
    {
        $list = $this->getList([
            'd_id', 'username', 'name', 'password', 'ctime', 'login_ip','d_id'
        ], $where, 'd_id desc', null, $page . ',' . $limit);
        $count = $this->count();
        foreach ($list as &$item) {
            $item['ctime'] = date("Y-m-d H:i", $item['ctime']);
        }
        return [$list, $count];
    }

    public function getAdminListByIds($where)
    {
        $_list = $this->getList(['id', 'name'], $where);
        $list = [];
        foreach ($_list as $v) {
            $list[$v['id']] = $v;
        }
        return $list;
    }
    public function department()
    {
        return $this->belongsTo('DepartmentModel','d_id','d_id')->field('d_id,d_name');
    }

}