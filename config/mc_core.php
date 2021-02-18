<?php

return [
    'permissions' => [
        'index' => [
            [
                'title' => "Truy cập",
                'name' => 'index',
                'guard_name' => 'web',
                'group_name' => "Hệ thống"
            ]
        ],
        'users' => [
            [
                'title' => "Truy cập",
                'name' => 'users.index',
                'guard_name' => 'web',
                'group_name' => "Người dùng"
            ],
            [
                'title' => "Xem chi tiết",
                'name' => 'users.show',
                'guard_name' => 'web',
                'group_name' => "Người dùng"
            ],
            [
                'title' => "Tạo",
                'name' => 'users.create',
                'guard_name' => 'web',
                'group_name' => "Người dùng"
            ],
            [
                'title' => "Sửa",
                'name' => 'users.edit',
                'guard_name' => 'web',
                'group_name' => "Người dùng"
            ],
            [
                'title' => "Xoá",
                'name' => 'users.destroy',
                'guard_name' => 'web',
                'group_name' => "Người dùng"
            ]
        ],
        'roles' => [
            [
                'title' => "Truy cập",
                'name' => 'roles.index',
                'guard_name' => 'web',
                'group_name' => "Quyền"
            ],
            [
                'title' => "Xem chi tiết",
                'name' => 'roles.show',
                'guard_name' => 'web',
                'group_name' => "Quyền"
            ],
            [
                'title' => "Tạo",
                'name' => 'roles.create',
                'guard_name' => 'web',
                'group_name' => "Quyền"
            ],
            [
                'title' => "Sửa",
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'group_name' => "Quyền"
            ],
            [
                'title' => "Xoá",
                'name' => 'roles.destroy',
                'guard_name' => 'web',
                'group_name' => "Quyền"
            ]
        ],
        'menus' => [
            [
                'title' => "Truy cập",
                'name' => 'menus.index',
                'guard_name' => 'web',
                'group_name' => "Menu"
            ],
            [
                'title' => "Tạo",
                'name' => 'menus.create',
                'guard_name' => 'web',
                'group_name' => "Menu"
            ],
            [
                'title' => "Sửa",
                'name' => 'menus.edit',
                'guard_name' => 'web',
                'group_name' => "Menu"
            ],
            [
                'title' => "Xoá",
                'name' => 'menus.destroy',
                'guard_name' => 'web',
                'group_name' => "Menu"
            ]
        ],
        'medias' => [
            [
                'title' => "Truy cập",
                'name' => 'medias.index',
                'guard_name' => 'web',
                'group_name' => "Media"
            ]
        ]
    ]
];
