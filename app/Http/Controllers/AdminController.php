<?php

namespace App\Http\Controllers;

use App\Http\Resources\userResourceCollection;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function employees()
    {
        $role = Role::where('name', 'Employee')->first();

        $data = User::where('role_id', $role->id)->get();

        $employees = new userResourceCollection($data);

        return response()->json(['data' => $employees], 200);
    }
}
