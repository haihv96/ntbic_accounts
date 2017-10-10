<?php

return [
    'root_server' => [
        'url' => [
            'assign_ticket' => 'http://accounts.ntbic.dev/api/sso_ticket/assign',
            'assign_token' => 'http://accounts.ntbic.dev/api/sso_ticket/assign_token'
        ]
    ],
    'token' => [
        'cookie_ttl' => 60
    ],
    'urls_to_return_token' => [
        'http://accounts.ntbic.dev/sso/set_cookie/',
        'http://csdl.ntbic.dev/sso/set_cookie/',
        'http://ntbic.dev/sso/set_cookie/',
    ]
];
