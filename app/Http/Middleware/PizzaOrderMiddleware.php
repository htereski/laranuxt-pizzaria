<?php

namespace App\Http\Middleware;

use App\Custom\Jwt;
use App\Models\PizzaOrder;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PizzaOrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = PizzaOrder::find($request->route('id'));

        if (!$order) {
            return response()->json(['message' => 'Pizza Order not founded'], 400);
        }

        $response = Jwt::decode();

        $user = User::where('email', $response->data->email)->first();

        if ($user->role->name === 'Admin' || $user->role->name === 'Employee' || $user->id === $order->user_id) {
            return $next($request);
        }

        if ($user->id !== $order->user->id) {
            throw new AccessDeniedHttpException();
        }

        return $next($request);
    }
}
