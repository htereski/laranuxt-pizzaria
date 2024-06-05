<?php

namespace App\Http\Controllers;

use App\Http\Requests\PizzaRequest;
use App\Http\Resources\PizzaResource;
use App\Http\Resources\PizzaResourceCollection;
use App\Models\Product;

class PizzaController extends Controller
{
    public function home()
    {
        $pizza = Product::where('type', 'Pizza')->paginate(5);

        $data = new PizzaResourceCollection($pizza);

        return response()->json($data, 200);
    }

    public function index()
    {
        $pizza = Product::where('type', 'Pizza')->paginate(5);

        $data = new PizzaResourceCollection($pizza);

        return response()->json($data, 200);
    }

    public function store(PizzaRequest $request)
    {
        $request->validated();

        $pizza = new Product();
        $pizza->name = $request->name;
        $pizza->pizza = $request->name . ' ' . $request->size;
        $pizza->price = $request->price;
        $pizza->type = $request->type;
        $pizza->size = $request->size;
        $pizza->category = $request->category;
        $pizza->save();

        return response()->json(['message' => 'Pizza created'], 201);
    }

    public function show($id)
    {
        $pizza = Product::find($id);

        if (!$pizza || $pizza->type != 'Pizza') {
            return response()->json(['message' => 'Pizza not found'], 404);
        }

        $data = new PizzaResource($pizza);

        return response()->json($data, 200);
    }

    public function update(PizzaRequest $request, $id)
    {
        $pizza = Product::find($id);

        if (!$pizza || $pizza->type != 'Pizza') {
            return response()->json(['message' => 'Pizza not found'], 404);
        }

        $request->validated();

        $pizza->name = $request->name;
        $pizza->pizza = $request->name . ' ' . $request->size;
        $pizza->price = $request->price;
        $pizza->type = $request->type;
        $pizza->size = $request->size;
        $pizza->category = $request->category;
        $pizza->save();

        return response()->json(['message' => 'Pizza updated'], 200);
    }

    public function destroy($id)
    {
        $pizza = Product::find($id);

        if (!$pizza || $pizza->type !== 'Pizza') {
            return response()->json(['message' => 'Pizza not found'], 404);
        }

        $pizza->delete();

        return response()->json(null, 204);
    }
}
