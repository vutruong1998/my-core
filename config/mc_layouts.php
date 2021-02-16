<?php

return [
    'main' => [
        [
            'text' => 'Dashboard',
            'route_action' => 'index',
            'route_actives' => 'index',
            'permissions' => 'index'
        ],
        [
            'text' => 'Menu',
            'route_action' => 'menus.index',
            'route_actives' => 'menus.*',
            'permissions' => 'menus.index'
        ],
        [
            'text' => 'Media',
            'route_action' => 'unisharp.lfm.show',
            'route_actives' => 'unisharp.lfm*',
            'permissions' => 'medias.index'
        ],
        [
            'text' => 'System',
            'route_action' => '',
            'route_actives' => [
                'users.*',
                'roles.*'
            ],
            'permissions' => [
                'users.index',
                'roles.index'
            ],
            'children' => [
                [
                    'text' => 'Users',
                    'route_action' => 'users.index',
                    'route_actives' => [
                        'users.*'
                    ],
                    'permission' => 'users.index'
                ],
                [
                    'text' => 'Roles',
                    'route_action' => 'roles.index',
                    'route_actives' => [
                        'roles.*'
                    ],
                    'permission' => 'roles.index'
                ],
                [
                    'text' => 'Config general',
                    'route_actives' => [
                    ],
                    'route_action' => ''
                ]
            ]
        ]
    ]
];
