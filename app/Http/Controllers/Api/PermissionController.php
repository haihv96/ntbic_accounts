<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    public function getDirectPermissions(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->getDirectPermissions()
        ], 200);
    }

    public function getPermissionsViaRoles(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->getPermissionsViaRoles()
        ], 200);
    }

    public function getAllPermissions(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->getAllPermissions()
        ], 200);
    }

    public function hasPermissionTo(Request $request)
    {
        $permission = $request->get('permission');
        $guardName = $request->get('guard_name');

        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->hasPermissionTo($permission, $guardName)
        ], 200);
    }
}
