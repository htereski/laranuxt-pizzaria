<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->only(['name', 'email', 'password']), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', Password::min(8)]
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data invalid', 'errors' => $validator->errors()], 400,);
        }

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
