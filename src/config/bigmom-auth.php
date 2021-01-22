<?php

return [
    
    'superusers' => [
        'admin@mail.io',
    ],

    'guard' => [
        // 'driver' => 'session',
        // 'provider' => 'users',
    ],

    // or username, for example.
    'user-identifier' => 'email',

    // please be careful when changing anything here.
    'packages' => [
        [
            'name' => 'Bigmom Auth',
            'description' => 'Centralized authentication for bigmom packages.',
            'routes' => [
                [
                    'title' => 'Manage permissions',
                    'name' => 'bigmom-auth.permission.getIndex',
                    'permission' => 'auth-manage',
                ]
            ],
            'permissions' => [
                'auth-access',
                'auth-manage',
            ]
        ],
    ]
];
