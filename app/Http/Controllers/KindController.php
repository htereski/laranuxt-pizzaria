<?php

namespace App\Http\Controllers;

use App\Http\Resources\KindResourceCollection;
use App\Models\Kind;
use Illuminate\Http\Request;

class KindController extends Controller
{
    public function index()
    {
        $kinds = new KindResourceCollection(Kind::all());

        return response()->json(['data' => $kinds], 200);
    }
}
