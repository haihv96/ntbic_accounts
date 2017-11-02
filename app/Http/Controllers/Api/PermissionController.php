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
            'data' => $request->user()->getDirectPermissions($request->get('source'))
        ], 200);
    }

    public function getPermissionsViaRoles(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->getPermissionsViaRoles($request->get('source'))
        ], 200);
    }

    public function getAllPermissions(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request->user()->getAllPermissions($request->get('source'))
        ], 200);
    }

    public function hasPermissionTo(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request
                ->user()
                ->hasPermissionTo($request->get('source'), $request->get('name'))
        ], 200);
    }

    public function hasAnyPermissionsTo(Request $request)
    {
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => $request
                ->user()
                ->hasAnyPermissionsTo($request->get('source'), $request->get('name'))
        ], 200);
    }
}
