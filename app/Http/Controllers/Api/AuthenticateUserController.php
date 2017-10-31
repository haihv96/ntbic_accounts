<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class AuthenticateUserController extends BaseController
{
    public function index(Request $request){
        return response()->json([
            'status' => 200,
            'message' => null,
            'data' => $request->user()
        ], 200);
    }
}
