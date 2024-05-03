<?php

namespace App\Http\Middleware;

use App\Models\PizzaOrder;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PizzaOrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = PizzaOrder::find($request->id);

        if (!$order) {
            return response()->json(['message' => 'Pizza Order not founded'], 400);
        }

        $role = Role::where('name', 'Custumer')->first();

        if (Auth::user()->role_id !== $role->id) {
            return $next($request);
        }

        if (Auth::user()->id !== $order->user_id) {
            return response()->json(['redirect_to' => route('home')]);
        }

        return $next($request);
    }
}
