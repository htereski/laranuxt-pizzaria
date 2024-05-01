<?php

namespace App\Http\Controllers;

use App\Http\Resources\PizzaResource;
use App\Http\Resources\PizzaResourceCollection;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->only(['name', 'kind_id']), [
            'name' => ['required', 'string', 'max:255', Rule::unique('pizzas')],
            'kind_id' => ['required', 'exists:kinds,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data invalid', 'erros' => $validator->errors()], 400);
        }

        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->kind_id = $request->kind_id;
        $pizza->save();

        return response()->json(['message' => 'Pizza Created'], 201);
    }

    public function show($id)
    {
        $pizza = new PizzaResource(Pizza::find($id));

        return response()->json(['data' => $pizza], 200);
    }
}
