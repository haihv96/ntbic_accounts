<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\GuzzleHttp\AuthorizeRequestServiceInterface;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    protected $authorizeRequestService;

    public function __construct(AuthorizeRequestServiceInterface $authorizeRequestService)
    {
        $this->authorizeRequestService = $authorizeRequestService;
    }

    public function handle($request, Closure $next)
    {
        $response = $this->authorizeRequestService->send(
            'get',
            config('sso.root_server.url.root') . '/api/check-authenticate'
        );

        if ($response->status == 200 && $response->data) {
            session(['current_user' => (object)$response->data]);
        }
        return $next($request);
    }
}
