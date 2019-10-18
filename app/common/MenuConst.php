<?php

namespace app\common;
class MenuConst
{
    public static $menu = [
        [
            'menuName' => '词管理',
            'ico'=> '&#xe600;',
            'list' => [
                [
                    'name' => '类别管理',
                    'url' => '/admin/category/categoryList',
                    'ico' => '&#xe624;',
                    'parent_id' => 0,
                    'status' => 1,
                ],
                [
                    'name' => '词列表管理',
                    'url' => '/admin/word/wordList',
                    'ico' => '&#xe624;',
                    'parent_id' => 0,
                    'status' => 1,
                ],

            ],
        ],
        [
            'menuName' => '用户管理',
            'ico'=> '&#xe60f;',
            'list' => [
                [
                    'name' => '部门管理',
                    'url' => '/admin/project/departmentList',
                    'ico' => '&#xe611;',
                    'parent_id' => 1,
                    'status' => 1,
                ],

                [
                    'name' => '用户列表',
                    'url' => '/admin/admin/adminList',
                    'ico' => '&#xe619;',
                    'parent_id' => 1,
                    'status' => 1,
                ],


            ],
        ],
        [
            'menuName' => '系统设置',
            'ico'=> '&#xe6b8;',
            'list' => [
                [
                    'name' => '栏目管理',
                    'url' => '/admin/menu/menuList',
                    'ico' => '&#xe611;',
                    'parent_id' => 1,
                    'status' => 1,
                ],
            ],
        ]
    ];
}