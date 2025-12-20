<?php

return [

    'default_guard' => 'portal',
    'defaults' => [
        'guard' => 'portal',
        'passwords' => 'portal_users',
    ],

    'guards' => [
        'portal' => [
            'driver' => 'session',
            'provider' => 'portal_users',
        ],
    ],

    'providers' => [
        'portal_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'portal_users' => [
            'provider' => 'portal_users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
