<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class AuthenticateUserController extends BaseController
{
    public function index(){
        return response()->json([
            'status' => 200,
            'message' => null,
            'data' => $this->currentUser
        ], 200);
    }
}
