<?php

namespace App\Http\Controllers;

use App\Http\Resources\SizeResource;
use App\Http\Resources\SizeResourceCollection;
use App\Models\Size;
use Illuminate\Http\Request;

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
}
