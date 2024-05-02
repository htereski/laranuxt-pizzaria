<?php

namespace App\Http\Controllers;

use App\Http\Resources\SizeResource;
use App\Http\Resources\SizeResourceCollection;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SizeController extends Controller
{
    public function index()
    {
        $data = Size::all();

        $sizes = new SizeResourceCollection($data);

        return response()->json(['data' => $sizes], 200);
    }

    public function show($id)
    {
        $data = Size::find($id);

        if ($data) {
            $size = new SizeResource($data);

            return response()->json(['data' => $size], 200);
        }

        return response()->json(['message' => 'Size not founded'], 400);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['name', 'value']), [
            'name' => ['required', 'max:255', Rule::unique('sizes')],
            'value' => ['required', 'numeric', 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data invalid', 'errors' => $validator->errors()], 400);
        }

        $size = new Size();
        $size->name = $request->name;
        $size->value = $request->value;
        $size->save();

        return response()->json(['message' => 'Size created'], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->only(['name', 'value']), [
            'name' => ['required', 'max:255', Rule::unique('sizes')->ignore($id)],
            'value' => ['required', 'numeric', 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data invalid', 'errors' => $validator->errors()], 400);
        }

        $size = Size::find($id);

        if ($size) {
            $size->name = $request->name;
            $size->value = $request->value;
            $size->save();

            return response()->json(['message' => 'Size Updated'], 200);
        }

        return response()->json(['message' => 'Size not founded'], 400);
    }
}
