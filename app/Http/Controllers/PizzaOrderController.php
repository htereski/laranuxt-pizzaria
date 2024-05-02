<?php

namespace App\Http\Controllers;

use App\Http\Resources\PizzaOrderCollection;
use App\Models\PizzaOrder;
use Illuminate\Http\Request;

class PizzaOrderController extends Controller
{
    public function index()
    {
        $data = PizzaOrder::all();

        $pizzaOrders = new PizzaOrderCollection($data);
        
        return response()->json(['data' => $pizzaOrders]);
    }
}
