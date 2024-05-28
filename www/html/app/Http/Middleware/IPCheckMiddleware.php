<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IPCheckMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
         */
        $blockedIPs = ['127.0.0.1'];

        if (in_array($request->ip(), $blockedIPs)) {
            return response()->json(['error' => 'Blocked IP address', 'status' => 403], 403);
        }

        return $next($request);
    }
}