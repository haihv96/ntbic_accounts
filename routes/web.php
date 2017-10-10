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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('sso/login', 'SsoController@login')->name('sso.login_form');
Route::post('sso/make_request', 'SsoController@makeRequest')->name('sso.login');
Route::get('sso/set_cookie/{sso_ticket_secret}', 'SsoController@setCookie');

## ROOT ROUTE
Route::get('/sso_ticket/authenticate/{ssoTicketSecret}', 'SsoTicketController@authenticateTicket')
    ->name('sso_ticket.authenticate');
Route::post('/sso_ticket/update_auth_ticket', 'SsoTicketController@updateAuthTicket')
    ->name('sso_ticket.update');
