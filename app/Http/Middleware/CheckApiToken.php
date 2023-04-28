<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        $apiToken = env('JWT_SECRET');

        if ($token !== 'Bearer '.$apiToken) {
            return response()->json(['error' => 'unauthorized', 'status' => 401], 401);
        }

        return $next($request);
    }
}
