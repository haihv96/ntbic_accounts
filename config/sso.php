<?php

return [
    'root_server' => [
        'url' => [
            'assign_ticket' => 'http://accounts.ntbic.dev/api/sso_ticket/assign',
            'assign_token' => 'http://accounts.ntbic.dev/api/sso_ticket/assign_token'
        ]
    ],
    'urls_to_return_token' => [
        'http://accounts.ntbic.dev/sso/set_session/',
        'http://csdl.ntbic.dev/sso/set_session/',
    ]
];
