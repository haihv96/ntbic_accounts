<?php

return [
    'root_server' => [
        'url' => [
            'assign_ticket' => 'http://accounts.ntbic.dev/api/sso-ticket/assign',
            'assign_token' => 'http://accounts.ntbic.dev/api/sso-ticket/assign-token'
        ]
    ],
    'urls_to_return_token' => [
        'http://accounts.ntbic.dev/sso/set-session/',
        'http://csdl.ntbic.dev/sso/set-session/',
    ]
];
