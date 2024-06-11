<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\PizzaResourceCollection;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        $request->validated();

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->stock = $request->stock;
        $product->save();

        return response()->json(['message' => 'Product created'], 201);
    }

    public function foods()
    {
        $foods = Product::where('type', 'Food')->paginate(5);

        $data = new ProductResourceCollection($foods);

        return response()->json($data, 200);
    }

    public function drinks()
    {
        $drinks = Product::where('type', 'Drink')->paginate(5);

        $data = new ProductResourceCollection($drinks);

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product || $product->type == 'Pizza') {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $data = new ProductResource($product);

        return response()->json($data, 200);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product || $product->type === 'Pizza') {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validated();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->stock = $request->stock;
        $product->save();

        return response()->json(['message' => 'Product updated'], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product || $product->type === 'Pizza') {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(null, 204);
    }
}
