<?php

namespace App\Http\Controllers;

use App\Repositories\SsoTicket\SsoTicketInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Validator;

class SsoTicketController extends Controller
{
    protected $ssoTicketRepository;

    public function __construct(SsoTicketInterface $ssoTicketRepository)
    {
        $this->ssoTicketRepository = $ssoTicketRepository;
    }

    public function updateAuthTicket(Request $request)
    {
        $validateUser = $this->validateUserLogin($request->only('email', 'password'));
        if ($ssoTicket = $this->ssoTicketRepository->findBy('sso_ticket_secret', $request->get('sso_ticket_secret'))) {
            return redirect()->route('sso_ticket.authenticate',
                $this->updateTicket($validateUser, $ssoTicket, $request));
        } else {
            return redirect($this->storeNewTicket($validateUser, $request)['data']['redirect_url']);
        }
    }

    public function authenticateTicket($ssoTicketSecret)
    {
        $ssoTicket = $this->ssoTicketRepository->findBy('sso_ticket_secret', $ssoTicketSecret);

        if ($ssoTicket) {

            if ($ssoTicket->access_token) {
                $newSsoTicketSecret = $this->ssoTicketRepository->createUniqueTicketSecret();
                $ssoTicket->update(['sso_ticket_secret' => $newSsoTicketSecret]);
                return redirect(config('sso.urls_to_return_token')[0] . $newSsoTicketSecret);
            } else {
                $ssoTicketClone = clone $ssoTicket;
                $ssoTicket->update([
                    'username_input' => null,
                    'password_input' => null,
                    'message' => null
                ]);
                return view('sso_ticket.authenticate', [
                    'email' => $ssoTicketClone->username_input,
                    'password' => $ssoTicketClone->password_input,
                    'sso_ticket_secret' => $ssoTicketSecret,
                    'errors' => json_decode($ssoTicketClone->message)
                ]);
            }
        } else {
            return redirect()->route('sso.login_form');
        }
    }


    protected function validateUserLogin($credentials)
    {
        $validate = Validator::make($credentials, [
            'email' => 'required | email | exists:users,email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return [
                'error' => true,
                'message' => $validate->errors()
            ];
        }

        try {
            if (!$access_token = JWTAuth::attempt($credentials)) {
                return [
                    'error' => true,
                    'message' => '{
                    "password": ["password invalid that email !"]}',
                    'data' => null
                ];
            }
        } catch (JWTException $e) {
            return [
                'error' => true,
                'message' => 'could not create token',
                'data' => null
            ];
        }

        return [
            'error' => false,
            'message' => null,
            'data' => compact('access_token')
        ];
    }

    protected function storeNewTicket($validateUser, $request)
    {
        $newSsoTicketSecret = $this->ssoTicketRepository->createUniqueTicketSecret();
        $redirectUrl = route('sso_ticket.authenticate', $newSsoTicketSecret);

        if ($validateUser['error']) {
            $this->ssoTicketRepository->create([
                'sso_ticket_secret' => $newSsoTicketSecret,
                'username_input' => $request->get('email'),
                'password_input' => $request->get('password'),
                'message' => $validateUser['message'],
                'return_url' => $request->get('return_url')
            ]);
            return [
                'error' => true,
                'message' => null,
                'data' => [
                    'redirect_url' => $redirectUrl
                ]
            ];
        } else {
            $this->ssoTicketRepository->create([
                'sso_ticket_secret' => $newSsoTicketSecret,
                'access_token' => $validateUser['data']['access_token'],
                'return_url' => $request->get('return_url')
            ]);
            return [
                'error' => false,
                'message' => null,
                'data' => [
                    'redirect_url' => $redirectUrl
                ]
            ];
        }
    }

    protected function updateTicket($validateUser, $ssoTicket, $request)
    {
        $newSsoTicketSecret = $this->ssoTicketRepository->createUniqueTicketSecret();
        if ($validateUser['error']) {
            $ssoTicket->update([
                'sso_ticket_secret' => $newSsoTicketSecret,
                'username_input' => $request->get('email'),
                'password_input' => $request->get('password'),
                'message' => $validateUser['message']
            ]);
        } else {
            $ssoTicket->update([
                'sso_ticket_secret' => $newSsoTicketSecret,
                'access_token' => $validateUser['data']['access_token']
            ]);
        }
        return $newSsoTicketSecret;
    }

    protected function nextUrl($currentUrl, $ssoTicketSecret)
    {
        $urls = config('sso.urls_to_return_token');
        $length = sizeof($urls);
        foreach ($urls as $index => $url) {
            if (strpos(" " . $currentUrl, $url) || strpos(" " . $url, $currentUrl)) {
                if ($index == $length - 1) {
                    return false;
                } else {
                    return $urls[$index + 1] . $ssoTicketSecret;
                }
            }
        }
    }
}
