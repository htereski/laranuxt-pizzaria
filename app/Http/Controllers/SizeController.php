<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Http\Resources\SizeResource;
use App\Http\Resources\SizeResourceCollection;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        $data = Size::all();

        if (!$data) {
            return response()->json(['message' => 'Size not founded'], 400);
        }

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

    public function store(SizeRequest $request)
    {
        $request->validated();

        $size = new Size();
        $size->name = $request->name;
        $size->value = $request->value;
        $size->save();

        return response()->json(['message' => 'Size created'], 200);
    }

    public function update(SizeRequest $request, $id)
    {
        $request->validated();

        $size = Size::find($id);

        if ($size) {
            $size->name = $request->name;
            $size->value = $request->value;
            $size->save();

            return response()->json(['message' => 'Size Updated'], 200);
        }

        return response()->json(['message' => 'Size not founded'], 400);
    }

    public function destroy($id)
    {
        $size = Size::find($id);

        if ($size) {
            $size->delete();

            return response()->json(['message' => 'Size deleted'], 200);
        }

        return response()->json(['message' => 'Size not founded'], 400);
    }
}
