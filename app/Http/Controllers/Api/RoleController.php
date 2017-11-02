<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function getRoleNames(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->getRoleNames($request->get('source'))
        ], 200);
    }

    public function hasAnyRoles(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()
                ->hasAnyRoles($request->get('source'), $request->get('name'))
        ], 200);
    }
}
