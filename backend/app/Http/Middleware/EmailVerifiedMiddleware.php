<?php

namespace App\Http\Middleware;

use App\Custom\Jwt;
use App\Exceptions\MailException;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = Jwt::decode();

        $user = User::where('email', $response->data->email)->first();

        if (
            $user instanceof MustVerifyEmail &&
            !$user->hasVerifiedEmail()
        ) {
            throw new MailException();
        }

        return $next($request);
    }
}
