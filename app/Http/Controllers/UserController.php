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

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role()->associate($role);
        $user->save();

        return response()->json(['message' => 'User created'], 201);
    }
}
