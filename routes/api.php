<?php

use Illuminate\Http\Request;

Route::namespace('Api')->group(function () {
    Route::middleware('jwt.auth')->group(function () {
        Route::get('check-authenticate', 'AuthenticateUserController@index');

        Route::group(['prefix' => 'role'], function () {
            Route::post('get-role-names', 'RoleController@getRoleNames');
            Route::post('has-any-roles', 'RoleController@hasAnyRoles');
        });

        Route::group(['prefix' => 'permission'], function () {
            Route::post('get-direct-permissions', 'PermissionController@getDirectPermissions');
            Route::post('get-permissions-via-roles', 'PermissionController@getPermissionsViaRoles');
            Route::post('get-all-permissions', 'PermissionController@getAllPermissions');
            Route::post('has-any-permissions-to', 'PermissionController@hasAnyPermissionsTo');
        });
    });

    Route::post('/sso-ticket/assign', 'AssignSsoTicketController@assignTicket');
    Route::post('/sso-ticket/assign-token', 'AssignSsoTicketController@assignAccessToken');
    Route::post('/sso-logout/assign-next-url', 'SsoLogoutController@assignNextUrl');
});
