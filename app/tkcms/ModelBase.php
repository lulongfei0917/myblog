<?php

namespace app\tkcms;

use think\Model;

class ModelBase extends Model
{
    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * 查询简单封装
     * @param $fields
     * @param null $where
     * @param null $order
     * @param null $group
     * @param null $limit
     * @param null $pageNum
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList($fields, $where = null, $order = null, $group = null, $limit = null, $pageNum = null)
    {
        $request = $this->field($fields);
        if (!empty($where)) {
            $request = $this->checkWhere($request, $where);
        }
        if ($order) $request->order($order);
        if ($group) $request->group($group);
        $request->limit($limit, $pageNum);
        $list = $request->select();
        if ($list) {
            return $list->toArray();
        }
        return [];
    }

    public function getPageList($fields, $where = null, $order = null, $group = null, $limit = null)
    {
        $request = $this->field($fields);
        if (!empty($where)) {
            $request = $this->checkWhere($request, $where);
        }
        if ($order) $request->order($order);
        if ($group) $request->group($group);
        $list = $request->paginate($limit);
        if ($list) {
            return $list;
        }
        return [];
    }

    public function checkWhere($obj, $where)
    {
        if (is_array($where)) {
            foreach ($where as $_key => $item) {
                $key = explode(' ', $_key);
                if (isset($key[1])) {
                    if ($key[1] == '!=') {
                        $key[1] = 'neq';
                    } elseif ($key[1] == '>') {
                        $key[1] = 'gt';
                    } elseif ($key[1] == '<') {
                        $key[1] = 'lt';
                    } elseif ($key[1] == 'like'){
                        $key[1] = 'like';
                    }
                    $obj->where($key[0], $key[1], $item);
                } else {
                    $obj->whereIn($key[0], $item);
                }
            }
        }
        return $obj;
    }

    public function countData($where)
    {
        $obj = $this->checkWhere($this, $where);
        return $obj->count();
    }

    public function deleteData($where)
    {
        $obj = $this->checkWhere($this, $where);
        return $obj->delete();
    }

    public function getOne($data, $with = [], $cache = false)
    {
        return parent::get($data, $with, $cache);
    }


    public function updateData($data, $where)
    {
        return parent::update($data, $where);
    }

}