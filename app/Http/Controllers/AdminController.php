<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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
}
