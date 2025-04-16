<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Authorization')) {
            $token = $request->bearerToken();

            Auth::setToken($token);

            if (auth()->check()) {
                return $next($request);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
