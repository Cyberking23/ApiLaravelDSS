<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'User not found'], 404);
        }
    } catch (JWTException $e) {
        return response()->json(['error' => 'Token is invalid'], 401);
    }

    return $next($request);
}
}
