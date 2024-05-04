<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function employees()
    {
        $role = Role::where('name', 'Employee')->first();

        $data = User::where('role_id', $role->id)->get();

        $employees = new UserResourceCollection($data);

        return response()->json(['data' => $employees], 200);
    }

    public function employee($id)
    {
        $role = Role::where('name', 'Employee')->first();

        $data = User::where('id', $id)->where('role_id', $role->id)->first();

        if ($data) {
            $employee = new UserResource($data);

            return response()->json(['data' => $employee], 200);
        }

        return response()->json(['message' => 'Employee not founded'], 200);
    }

    public function registerEmployee(UserRequest $request)
    {
        $request->validated();

        $role = Role::where('name', 'Employee')->first();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role()->associate($role);
        $user->save();

        return response()->json(['message' => 'Employee created'], 200);
    }

    public function updateEmployee(UserRequest $request, $id)
    {
        $request->validated();

        $role = Role::where('name', 'Employee')->first();

        $data = User::where('id', $id)->where('role_id', $role->id)->first();

        if ($data) {
            $data->name = $request->name;
            $data->email = $request->email;
            $data->save();

            return response()->json(['message' => 'Employee updated'], 200);
        }

        return response()->json(['message' => 'Employee not founded'], 400);
    }
}
