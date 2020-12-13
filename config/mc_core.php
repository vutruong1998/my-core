<?php

return [
    'permissions' => [
        'users' => [
            [
                'name' => 'users.index',
                'guard_name' => 'web'
            ],
            [
                'name' => 'users.create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'users.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'users.destroy',
                'guard_name' => 'web'
            ]
        ],
        'roles' => [
            [
                'name' => 'roles.index',
                'guard_name' => 'web'
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'roles.edit',
                'guard_name' => 'web'
            ],
            [
                'name' => 'roles.destroy',
                'guard_name' => 'web'
            ]
        ]
    ]
];