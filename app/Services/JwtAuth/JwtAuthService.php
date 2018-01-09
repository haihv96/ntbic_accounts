<?php

namespace App\Services\JwtAuth;

class JwtAuthService implements JwtAuthInterface
{
    public static function user()
    {
        return session()->get('current_user');
    }

    public static function guest()
    {
        return !session()->has('current_user');
    }
}