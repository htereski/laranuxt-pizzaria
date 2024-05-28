<?php

namespace App\Http\Controllers;

use App\Http\Requests\PizzaOrderRequest;
use App\Http\Resources\PizzaOrderResource;
use App\Http\Resources\PizzaOrderResourceCollection;
use App\Models\PizzaOrder;

class PizzaOrderController extends Controller
{
    public function index()
    {
        $data = PizzaOrder::paginate(5);

        if (!$data->items()) {
            return response()->json(['message' => 'PizzaOrder not founded'], 400);
        }

        $pizzaOrders = new PizzaOrderResourceCollection($data);

        return response()->json($pizzaOrders, 200);
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

    public function store(PizzaOrderRequest $request)
    {
        $request->validated();

        $pizzaOrder = new PizzaOrder();
        $pizzaOrder->value = $request->value;
        $pizzaOrder->pizza_id = $request->pizza_id;
        $pizzaOrder->size_id = $request->size_id;
        $pizzaOrder->user_id = $request->user_id;
        $pizzaOrder->save();

        return response()->json(['message' => 'Pizza Order Created'], 200);
    }

    public function update(PizzaOrderRequest $request, $id)
    {
        $request->validated();

        $pizzaOrder = PizzaOrder::find($id);

        if ($pizzaOrder) {
            $pizzaOrder->value = $request->value;
            $pizzaOrder->pizza_id = $request->pizza_id;
            $pizzaOrder->size_id = $request->size_id;
            $pizzaOrder->user_id = $request->user_id;
            $pizzaOrder->save();

            return response()->json(['message' => 'Pizza Order Updated'], 200);
        }

        return response()->json(['message' => 'Pizza Order not founded'], 400);
    }

    public function destroy($id)
    {
        $pizzaOrder = PizzaOrder::find($id);

        if ($pizzaOrder) {
            $pizzaOrder->delete();

            return response()->json(['message' => 'Pizza Order Deleted'], 200);
        }

        return response()->json(['message' => 'Pizza Order not founded'], 400);
    }
}
