<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    public function getDirectPermissions()
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $this->currentUser->getDirectPermissions()
        ], 200);
    }

    public function getPermissionsViaRoles()
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $this->currentUser->getPermissionsViaRoles()
        ], 200);
    }

    public function getAllPermissions()
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $this->currentUser->getAllPermissions()
        ], 200);
    }

    public function hasPermissionTo(Request $request)
    {
        $permission = $request->get('permission');
        $guardName = $request->get('guard_name');

        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $this->currentUser->hasPermissionTo($permission, $guardName)
        ], 200);
    }
}
