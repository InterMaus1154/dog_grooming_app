<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RouteAccessLog
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->isLocal() && auth()->check()) {
            activity('route')
                ->causedBy(auth()->user())
                ->withProperties(['url' => $request->url(), 'method' => $request->method()])
                ->log('Route accessed');
        }
        return $next($request);
    }
}
