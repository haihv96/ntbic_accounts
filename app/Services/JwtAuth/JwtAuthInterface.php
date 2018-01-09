<?php

namespace App\Services\JwtAuth;

interface JwtAuthInterface
{
    public static function user();
    public static function guest();
}