<?php

namespace App\Http\Controllers;

use App\Http\Resources\PizzaOrderResource;
use App\Http\Resources\PizzaOrderResourceCollection;
use App\Models\PizzaOrder;
use Illuminate\Http\Request;

class PizzaOrderController extends Controller
{
    public function index()
    {
        $data = PizzaOrder::all();

        $pizzaOrders = new PizzaOrderResourceCollection($data);

        return response()->json(['data' => $pizzaOrders]);
    }

    public function show($id)
    {
        $data = PizzaOrder::find($id);

        if ($data) {
            $pizzaOrder = new PizzaOrderResource($data);

            return response()->json(['data' => $pizzaOrder], 200);
        }

        return response()->json(['message' => 'Pizza Order not founded'], 400);
    }
}
