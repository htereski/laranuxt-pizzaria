<?php

namespace App\Http\Controllers;

use App\Http\Resources\KindResourceCollection;
use App\Models\Kind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KindController extends Controller
{
    public function index()
    {
        $kinds = new KindResourceCollection(Kind::all());

        return response()->json(['data' => $kinds], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['name', 'multiplier']), [
            'name' => ['required', 'max:255', Rule::unique('kinds')],
            'multiplier' => ['required', 'numeric', 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data invalid', 'errors' => $validator->errors()], 400);
        }

        $kind = new Kind();
        $kind->name = $request->name;
        $kind->multiplier = $request->multiplier;
        $kind->save();

        return response()->json(['message' => 'Kind Created'], 201);
    }
}
