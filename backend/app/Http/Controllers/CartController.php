<?php

namespace App\Http\Controllers;

use App\Custom\Jwt;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;

class CartController extends Controller
{
    private function getUserFromToken()
    {
        $decodedToken = Jwt::decode();
        return User::where('email', $decodedToken->data->email)->with('role')->first();
    }

    public function index()
    {
        $user = $this->getUserFromToken();
        $carts = Cart::where('user_id', $user->id)->get();

        $data = $carts->map(function ($cart) {
            return [
                'id' => $cart->id,
                'total' => $cart->total,
            ];
        });

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $user = $this->getUserFromToken();
        $cart = Cart::where('id', $id)->where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $items = CartItem::where('cart_id', $cart->id)->with('product')->get();

        $products = $items->map(function ($item) {
            $product = $item->product;
            return [
                'id' => $product->id,
                'name' => $product->name,
                'pizza' => $product->pizza,
                'price' => $product->price,
                'type' => $product->type,
                'size' => $product->size,
                'category' => $product->category,
                'qty' => $item->quantity,
            ];
        });

        $data = [
            "data" => ["products" => $products, "total" => $cart->total],
        ];

        return response()->json($data, 200);
    }

    public function create()
    {
        $user = $this->getUserFromToken();

        if ($user->role->name !== 'Customer') {
            return response()->json(['message' => 'Only customers can create a cart.'], 404);
        }

        $cart = new Cart();
        $cart->user()->associate($user);
        $cart->total = 0;
        $cart->save();

        return response()->json(['message' => 'Cart created'], 200);
    }

    public function delete($id)
    {
        $user = $this->getUserFromToken();
        $cart = Cart::where('id', $id)->where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $payments = Payment::where('cart_id', $id)->where('user_id', $user->id)->get();
        $items = CartItem::where('cart_id', $id)->get();

        foreach ($payments as $payment) {
            $payment->delete();
        }

        foreach ($items as $item) {
            $item->delete();
        }

        $cart->delete();

        return response()->json('Cart deleted', 200);
    }

    public function add(CartRequest $request)
    {
        $request->validated();

        $user = $this->getUserFromToken();
        $cart = Cart::where('user_id', $user->id)->where('id', $request->cart_id)->first();
        $product = Product::find($request->product_id);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $request->product_id)->where('paid', 0)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
        } else {
            $cartItem = new CartItem();
            $cartItem->product()->associate($product);
            $cartItem->cart()->associate($cart);
            $cartItem->quantity = $request->quantity;
            $cartItem->paid = 0;
        }

        $cartItem->save();
        $cart->total += $product->price * $request->quantity;
        $cart->save();

        return response()->json(['message' => 'Product added to cart'], 200);
    }

    public function remove($cart_id, $product_id)
    {
        $user = $this->getUserFromToken();
        $cart = Cart::where('user_id', $user->id)->where('id', $cart_id)->first();
        $product = Product::find($product_id);
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product_id)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }

        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cart->total -= $product->price;
        } else {
            $cart->total -= $product->price * $cartItem->quantity;
            $cartItem->delete();
        }

        $cart->save();

        return response()->json(['message' => 'Product removed from cart'], 200);
    }
}
