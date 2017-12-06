<?php

namespace App\Http\Middleware;

use App\Services\GuzzleHttp\AuthorizeRequestServiceInterface;
use Closure;

class RoleAuthenticated
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

    public function handle($request, Closure $next, $source, $roleNames)
    {
        $response = $this->authorizeRequestService->send(
            'post',
            config('sso.root_server.url.root') . '/api/role/has-any-roles',
            $source, $roleNames
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
