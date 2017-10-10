<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsoTicket extends Model
{
    protected $fillable = [
        'sso_ticket_secret',
        'access_token',
        'username_input',
        'password_input',
        'message',
        'return_url'
    ];
}
