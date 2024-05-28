<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function employees()
    {
        $role = Role::where('name', 'Employee')->first();

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $data = User::where('role_id', $role->id)->paginate(5);

        if (!$data->items()) {
            return response()->json(['message' => 'Employees not founded'], 400);
        }

        $employees = new UserResourceCollection($data);

        return response()->json($employees, 200);
    }

    public function employee($id)
    {
        $role = Role::where('name', 'Employee')->first();

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $data = User::where('id', $id)->where('role_id', $role->id)->first();

        if ($data) {
            $employee = new UserResource($data);

            return response()->json(['data' => $employee], 200);
        }

        return response()->json(['message' => 'Employee not founded'], 400);
    }

    public function registerEmployee(UserRequest $request)
    {
        $request->validated();

        $role = Role::where('name', 'Employee')->first();

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

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

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $data = User::where('id', $id)->where('role_id', $role->id)->first();

        if ($data) {
            $data->name = $request->name;
            $data->email = $request->email;
            $data->save();

            return response()->json(['message' => 'Employee updated'], 200);
        }

        return response()->json(['message' => 'Employee not founded'], 400);
    }

    public function destroyEmployee($id)
    {
        $role = Role::where('name', 'Employee')->first();

        $data = User::where('id', $id)->where('role_id', $role->id)->first();

        if ($data) {
            $data->delete();

            return response()->json(['message' => 'Employee deleted'], 200);
        }

        return response()->json(['message' => 'Employee not founded'], 400);
    }
}
