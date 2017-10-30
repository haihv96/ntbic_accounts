<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function getRoleNames()
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $this->currentUser->getRoleNames()
        ], 200);
    }

    public function hasRole(Request $request)
    {
        $guardName = $request->get('guard_name');
        $role = $request->get('role');
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $this->currentUser->hasRole($role, $guardName)
        ], 200);
    }
}
