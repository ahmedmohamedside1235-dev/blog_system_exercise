<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProxySecret
{
    public function handle(Request $request, Closure $next): Response
    {
        $secret = config('services.proxy_secret');

        if (empty($secret) || $request->header('X-Proxy-Secret') !== $secret) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
