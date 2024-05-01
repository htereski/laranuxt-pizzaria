<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $request->validated();

        $role = Role::where('name', 'Custumer')->first();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->passwrod);
        $user->role()->associate($role);
        $user->save();

        return response()->json(['message' => 'User created'], 200);
    }
}
