<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {
    Route::middleware('jwt.auth')->group(function () {
        Route::post('user', function (Request $request) {
            return $request->user();
        });
    });

    Route::post('/sso_ticket/assign', 'AssignSsoTicketController@assignTicket');
    Route::post('/sso_ticket/assign_token', 'AssignSsoTicketController@assignAccessToken');
});
