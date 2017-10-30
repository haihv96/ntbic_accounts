<?php

use Illuminate\Http\Request;

Route::namespace('Api')->group(function () {
    Route::middleware('jwt.auth')->group(function () {
        Route::post('check-authenticate', 'AuthenticateUserController@index');

        Route::group(['prefix' => 'role'], function () {
            Route::get('get-role-names', 'RoleController@getRoleNames');
            Route::post('has-role', 'RoleController@hasRole');
        });

        Route::group(['prefix' => 'permission'], function () {
            Route::get('get-direct-permissions', 'PermissionController@getDirectPermissions');
            Route::get('get_permissions_via_roles', 'PermissionController@getPermissionsViaRoles');
            Route::get('get_all_permissions', 'PermissionController@getAllPermissions');
            Route::post('has_permission_to', 'PermissionController@hasPermissionTo');
        });
    });

    Route::post('/sso-ticket/assign', 'AssignSsoTicketController@assignTicket');
    Route::post('/sso-ticket/assign-token', 'AssignSsoTicketController@assignAccessToken');
});
