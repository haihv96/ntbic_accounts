<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SsoLogoutController extends Controller
{
    public function assignNextUrl(Request $request)
    {
        $currentUrl = $request->get('current_url');
        $returnUrl = $request->get('return_url');
        $urls = config('sso.urls_to_logout');
        $length = sizeof($urls);
        foreach ($urls as $index => $url) {
            if (strpos(" " . $currentUrl, $url) || strpos(" " . $url, $currentUrl)) {
                if ($index == $length - 1) {
                    $nextUrl = $returnUrl;
                } else {
                    $nextUrl = $urls[$index + 1] . '?return_url=' . $returnUrl;
                }

            }
        }
        return response()->json([
            'error' => false,
            'message' => null,
            'data' => [
                'next_url' => $nextUrl
            ]
        ]);
    }
}