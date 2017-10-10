<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\SsoTicketController;
use Illuminate\Http\Request;

class AssignSsoTicketController extends ssoTicketController
{
    public function assignTicket(Request $request)
    {
        $validateUser = $this->validateUserLogin($request->only('email', 'password'));
        return response()->json(
            $this->storeNewTicket($validateUser, $request)
        );
    }

    public function assignAccessToken(Request $request)
    {
        $ssoTicket = $this->ssoTicketRepository
            ->findBy('sso_ticket_secret', $request->get('sso_ticket_secret'));
        if ($ssoTicket && !empty($ssoTicket->access_token)) {
            $newSsoTicketSecret = $this->ssoTicketRepository->createUniqueTicketSecret();
            $ssoTicket->update(['sso_ticket_secret' => $newSsoTicketSecret]);
            if (!$nextUrl = $this->nextUrl($request->get('current_url'), $newSsoTicketSecret)) {
                $nextUrl = $ssoTicket->return_url;
                $ssoTicket->delete();
            }
            return response()->json([
                'error' => false,
                'data' => [
                    'access_token' => $ssoTicket->access_token,
                    'redirect_url' => $nextUrl
                ]
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'data' => null,
                'message' => 'ticket key is expired !'
            ], 404);
        }
    }
}
