<?php

namespace App\Http\Controllers;

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
}
