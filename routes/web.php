<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

## SSO ROUTE
Route::get('sso/login', 'SsoController@login')->name('sso.login_form');
Route::post('sso/make-request', 'SsoController@makeRequest')->name('sso.login');
Route::get('sso/set-session/{ssoTicketSecret}', 'SsoController@setSession');
Route::get('sso/logout', 'SsoController@destroySession');


## ROOT ROUTE
Route::get('/sso-ticket/authenticate/{ssoTicketSecret}', 'SsoTicketController@authenticateTicket')
    ->name('sso_ticket.authenticate');
Route::post('/sso-ticket/update-auth-ticket', 'SsoTicketController@updateAuthTicket')
    ->name('sso_ticket.update');

Route::group(['prefix' => 'management', 'namespace' => 'Management'], function () {
    Route::resource('dashboards', 'DashboardController', ['only' => ['index']]);
    Route::resource('users', 'UserController', ['except' => ['show']]);

    Route::group(['prefix' => '{source}'], function() {
    	Route::resource('permissions', 'PermissionController', ['except' => 'show']);
    	Route::resource('roles', 'RolePermissionController', ['except' => 'show']);

    	Route::resource('user-roles', 'UserRoleController', ['only' => ['index', 'edit', 'update']]);
    	Route::resource('user-permissions', 'UserPermissionController', ['only' => ['index', 'edit', 'update']]);
    });
});
