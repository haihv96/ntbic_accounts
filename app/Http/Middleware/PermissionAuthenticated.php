<?php

namespace App\Http\Middleware;

use App\Services\GuzzleHttp\AuthorizeRequestServiceInterface;
use Closure;

class PermissionAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    protected $authorizeRequestService;

    public function __construct(AuthorizeRequestServiceInterface $authorizeRequestService)
    {
        $this->authorizeRequestService = $authorizeRequestService;
    }

    public function handle($request, Closure $next, $source, $permissionNames)
    {
        $response = $this->authorizeRequestService->send(
            'post',
            config('sso.root_server.url.root') . '/api/permission/has-any-permissions-to',
            $source, $permissionNames
        );
        if ($response->status != 200) {
            return redirect()->route('sso.login_form');
        }
        if ($response->status == 200 && $response->data !== true) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
