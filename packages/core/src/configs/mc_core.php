<?php

return [
    'permissions' => [
        'users' => [
            [
                'name' => 'users.index',
                'display_name' => 'Danh sách',
                'model' => 'User'
            ],
            [
                'name' => 'users.create',
                'display_name' => 'Tạo mới',
                'model' => 'User'
            ],
            [
                'name' => 'users.edit',
                'display_name' => 'Cập nhật',
                'model' => 'User'
            ],
            [
                'name' => 'users.destroy',
                'display_name' => 'Xóa',
                'model' => 'User'
            ]
        ],
        'roles' => [
            [
                'name' => 'roles.index',
                'display_name' => 'Danh sách',
                'model' => 'Role'
            ],
            [
                'name' => 'roles.create',
                'display_name' => 'Tạo mới',
                'model' => 'Role'
            ],
            [
                'name' => 'roles.edit',
                'display_name' => 'Cập nhật',
                'model' => 'Role'
            ],
            [
                'name' => 'roles.destroy',
                'display_name' => 'Xóa',
                'model' => 'Role'
            ]
        ]
    ]
];