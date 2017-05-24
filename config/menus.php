<?php

return [
    'admin' => [
        [
            'label' => 'admin.menu_list.site',
            'icon' => 'fa fa-files-o',
            'children' => [
                [
                    'label' => 'admin.menu_list.setting',
                    'url' => 'admin/setting'
                ],
            ],
        ],
        [
            'label' => 'admin.menu_list.user',
            'icon' => 'fa fa-files-o',
            'children' => [
                [
                    'label' => 'admin.menu_list.user_list',
                    'url' => 'admin/user/list'
                ],
                [
                    'label' => 'admin.menu_list.user_add',
                    'url' => 'admin/user/add'
                ],
            ],
        ],
        [
            'label' => 'admin.menu_list.entrust',
            'icon' => 'fa fa-files-o',
            'children' => [
                [
                    'label' => 'admin.menu_list.role',
                    'url' => 'admin/role/list'
                ],
                [
                    'label' => 'admin.menu_list.permission',
                    'url' => 'admin/permission/list'
                ],
            ],
        ],
        [
            'label' => 'admin.menu_list.oauth',
            'icon' => 'fa fa-files-o',
            'children' => [
                [
                    'label' => 'admin.menu_list.oauth_client',
                    'url' => 'admin/oauth/client/list'
                ],
                [
                    'label' => 'admin.menu_list.oauth_scope',
                    'url' => 'admin/oauth/scope/list'
                ],
//                [
//                    'label' => 'admin.menu_list.oauth_grant',
//                    'url' => 'admin/oauth/grant/list'
//                ],
            ],
        ],
    ],
];
