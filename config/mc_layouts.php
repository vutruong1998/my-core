<?php

return [
    'main' => [
        [
            'text' => 'Dashboard',
            'route_action' => 'index'
        ],
        [
            'text' => 'Menu',
            'route_action' => 'menus.index',
            'permissions' => [
                'menus.index'
            ]
        ],
        [
            'text' => 'System',
            'route_action' => '',
            'permissions' => [
                'users.index',
                'roles.index'
            ],
            'children' => [
                [
                    'text' => 'Users',
                    'route_action' => 'users.index',
                    'permission' => 'users.index'
                ],
                [
                    'text' => 'Roles',
                    'route_action' => 'roles.index',
                    'permission' => 'roles.index'
                ],
                [
                    'text' => 'Config general',
                    'route_action' => ''
                ]
            ]
        ]
    ]
];
