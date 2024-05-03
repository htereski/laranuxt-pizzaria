<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'Not Authorized'], 403);
        }

        $user = $request->user();

        $role = Role::find($user->role_id);

        $token = $user->createToken('login', [$role->name])->plainTextToken;

        if (!$user->hasVerifiedEmail()) {
            event(new Registered($user));
            
            return response()->json(['message' => 'Email not verified', 'redirect_to' => route('verification.notice')], 403, ['token' => $token]);
        }

        return response()->json(['message' => 'Authorized'], 200, ['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Token Revoked'], 200);
    }
}
