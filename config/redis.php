<?php

return [
    'defaultConnection' => 'default',
    'connections'       => [
        'default' => [
            //https://github.com/predis/predis/wiki/Connection-Parameters
            'parameters' => [
                'scheme'   => 'tcp',
                'host'     => env('REDIS_HOST', '127.0.0.1'),
                'port'     => env('REDIS_PORT', '6379'),
                'password' => env("REDIS_PASSWD", ''),
                'database' => 1,
            ],
            //https://github.com/predis/predis/wiki/Client-Options
            'options'    => null
        ]
    ]
];