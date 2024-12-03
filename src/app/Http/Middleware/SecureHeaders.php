<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local')) {
            return $next($request);
        }

        $response = $next($request);

        if ($request->expectsJson()) {
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        }
        $response->headers->set('Strict-Transport-Security', 'max-age=15724800; includeSubdomains');
        $response->headers->set('Content-Security-Policy', 'reflected-xss block');

        return $response;
    }
}
