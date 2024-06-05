<?php

use App\Exceptions\MailException;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\EmailVerifiedMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'email' => EmailVerifiedMiddleware::class,
            'auth' => AuthMiddleware::class,
            'role' => RoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $e, Request $request) {

            if ($e instanceof AccessDeniedHttpException) {
                return response()->json(['error' => 'Access Denied'], 403, ['Location' => route('home')]);
            }

            if ($e instanceof AuthenticationException) {
                return response()->json(['error' => 'Authentication Required'], 302, ['Location' => route('login')]);
            }

            if ($e instanceof MissingAbilityException) {
                return response()->json(['error' => 'Missing Ability'], 403, ['Location' => route('login')]);
            }

            if ($e instanceof MailException) {
                return response()->json(['error' => 'Mail Error'], 403, ['Location' => route('verification.notice')]);
            }
        });
    })->create();
