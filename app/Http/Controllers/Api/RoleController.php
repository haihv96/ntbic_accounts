<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function getRoleNames(Request $request)
    {
        $guardName = $request->get('guard_name');
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->getRoleNames()
        ], 200);
    }

    public function hasRole(Request $request)
    {
        $guardName = $request->get('guard_name');
        $role = $request->get('role');
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->hasRole($role, $guardName)
        ], 200);
    }
}
