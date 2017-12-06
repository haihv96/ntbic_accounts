<?php

namespace App\Services\GuzzleHttp;

interface AuthorizeRequestServiceInterface
{
    public function send($method, $url, $name = null);

    public function authorizeActions(array $actions);
}