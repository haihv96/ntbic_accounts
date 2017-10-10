<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Cookie;

class SsoController extends Controller
{
    public function login()
    {
        return view('sso.login');
    }

    public function makeRequest(Request $request)
    {
        $http = new GuzzleHttp\Client;
        $request_sso_ticket = $http->post(config('sso.root_server.url.assign_ticket'), [
            'form_params' => [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'return_url' => $request->get('return_url')
            ],
            'http_errors' => false
        ]);
        $redirect_url = json_decode((string)$request_sso_ticket->getBody(), true)['data']['redirect_url'];
        return redirect($redirect_url);
    }

    public function setCookie($ssoTicketSecret)
    {
        $http = new GuzzleHttp\Client;
        $request_access_token = $http->post(config('sso.root_server.url.assign_token'), [
            'form_params' => [
                'sso_ticket_secret' => $ssoTicketSecret,
                'current_url' => config('app.url')
            ],
            'http_errors' => false
        ]);
        $response = json_decode((string)$request_access_token->getBody(), true);

        if ($response['error']) {
            return redirect()->route('sso.login_form');
        } else {
            Cookie::queue('access_token', $response['data']['access_token'], config('sso.token.cookie_ttl'));
            return redirect($response['data']['redirect_url']);
        }
    }
}
