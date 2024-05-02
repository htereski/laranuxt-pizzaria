<?php

namespace App\Http\Controllers;

use App\Http\Requests\PizzaRequest;
use App\Http\Resources\PizzaResource;
use App\Http\Resources\PizzaResourceCollection;
use App\Models\Pizza;

class PizzaController extends Controller
{
    public function index($id)
    {
        $data = Pizza::where('kind_id', $id)->with('kind')->get();

        $pizzas = new PizzaResourceCollection($data);

        return response()->json(['data' => $pizzas], 200);
    }

    public function show($id)
    {
        $data = Pizza::find($id);

        if ($data) {
            $pizza = new PizzaResource($data);
            return response()->json(['data' => $pizza], 200);
        }

        return response()->json(['message' => 'Pizza not founded'], 400);
    }

    public function store(PizzaRequest $request)
    {
        $request->validated();

        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->kind_id = $request->kind_id;
        $pizza->save();

        return response()->json(['message' => 'Pizza Created'], 201);
    }

    public function update(PizzaRequest $request, $id)
    {
        $data = Pizza::find($id);

        if ($data) {
            $request->validated();

            $data->name = $request->name;
            $data->kind_id = $request->kind_id;
            $data->save();

            return response()->json(['message' => 'Pizza Updated'], 200);
        }

        return response()->json(['message' => 'Pizza not founded'], 400);
    }

    public function destroy($id)
    {
        $pizza = Pizza::find($id);

        if ($pizza) {
            $pizza->delete();

            return response()->json(['message' => 'Pizza Deleted'], 200);
        }

        return response()->json(['message' => 'Pizza not founded'], 400);
    }
}
