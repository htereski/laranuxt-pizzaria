<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'Not Authorized'], 403);
        }

        $token = $request->user()->createToken('login')->plainTextToken;

        return response()->json(['message' => 'Authorized'], 200, ['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json('Token Revoked', 200);
    }
}
