<?php

namespace App\Http\Controllers;

use App\Http\Resources\PizzaResourceCollection;
use App\Models\Kind;
use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index($id)
    {
        $data = Pizza::with('kind')
            ->whereHas('kind', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();

        $pizzas = new PizzaResourceCollection($data);

        return response()->json(['data' => $pizzas], 200);
    }
}
