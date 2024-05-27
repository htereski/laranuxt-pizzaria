<?php

namespace App\Http\Middleware;

use App\Custom\Jwt;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (!Jwt::validate()) {
            return response()->json('Token invalid', 401);
        }

        $decodedToken = Jwt::decode();

        $user = User::where('email', $decodedToken->data->email)->first();

        if (!$user) {
            return response()->json('User not found', 401);
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
