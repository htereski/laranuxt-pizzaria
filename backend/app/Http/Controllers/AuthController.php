<?php

namespace App\Http\Controllers;

use App\Custom\Jwt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $request->user();

        $token = Jwt::create($user);

        if (!$user->hasVerifiedEmail()) {
            event(new Registered($user));
            return response()->json(['message' => 'Email not verified'], 403, ['Authorization' => $token]);
        }

        // $cookie = cookie('laranuxt_session', $token, 60, null, null, true, true);

        $data = [
            'name' => $user->name,
            'role' => $user->role->name
        ];

        return response()->json(['message' => 'Authorized', 'data' => $data, 'laranuxt_session' => $token], 200, ['Authorization' => $token]);
    }

    public function check()
    {
        if (Jwt::validate()) {
            return response()->json(['message' => 'Authorized'], 200);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
