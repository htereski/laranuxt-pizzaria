<?php

namespace App\Http\Middleware;

use App\Custom\Jwt;
use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedRoles): Response
    {
        $response = Jwt::decode();

        $user = User::where('email', $response->data->email)->first();

        if (!$user || !in_array($user->role->name, $allowedRoles)) {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
