<?php

namespace App\Http\Controllers;

use App\Custom\Jwt;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Support\Str;


class MPController extends Controller
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }

    public function checkout($cart_id)
    {
        $decodedToken = Jwt::decode();

        $user = User::where('email', $decodedToken->data->email)->first();
        $cart = Cart::where('user_id', $user->id)->where('id', $cart_id)->first();

        if (!$cart) {
            return response()->json('Unable to checkout', 400);
        }

        $items = CartItem::where('cart_id', $cart->id)->where('paid', 0)->get();

        if ($items->isEmpty()) {
            return response()->json('Unable to checkout', 400);
        }

        $external_reference = (string) Str::uuid();

        $itemsArray = $this->processCartItems($items, $external_reference);

        $data = [
            "items" => $itemsArray,
            "external_reference" => $external_reference,
        ];

        $client = new PreferenceClient();
        $preference = $client->create($data);

        $this->createPayment($user, $cart, $external_reference, $cart->total);

        return response()->json(null, 200, ['Location' => $preference->init_point]);
    }

    public function handle(Request $request)
    {
        $xSignature = $_SERVER['HTTP_X_SIGNATURE'] ?? null;
        $xRequestId = $_SERVER['HTTP_X_REQUEST_ID'] ?? null;

        if (is_null($xSignature) || is_null($xRequestId)) {
            Log::error('Signature or Request ID header missing');
            return response()->json(['status' => 'failed'], 400);
        }

        $dataID = $request->input('data.id') ?? '';

        if ($this->verifySignature($xSignature, $xRequestId, $dataID)) {
            return $this->handlePaymentCreated($request);
        } else {
            Log::error('HMAC verification failed');
            return response()->json(['status' => 'failed'], 400);
        }
    }

    private function verifySignature($xSignature, $xRequestId, $dataID)
    {
        $parts = explode(',', $xSignature);
        $ts = null;
        $hash = null;

        foreach ($parts as $part) {
            $keyValue = explode('=', $part, 2);
            if (count($keyValue) == 2) {
                $key = trim($keyValue[0]);
                $value = trim($keyValue[1]);
                if ($key === "ts") {
                    $ts = $value;
                } elseif ($key === "v1") {
                    $hash = $value;
                }
            }
        }

        if (is_null($ts) || is_null($hash)) {
            return false;
        }

        $secret = env('MP_WEBHOOK_SECRET');
        $manifest = "id:$dataID;request-id:$xRequestId;ts:$ts;";
        $sha = hash_hmac('sha256', $manifest, $secret);

        Log::info(['calculated' => $sha, 'received' => $hash]);

        return hash_equals($sha, $hash);
    }

    private function handlePaymentCreated(Request $request)
    {
        if ($request->action === "payment.created") {
            try {
                $id = $request->input('data.id');
                $paymentClient = new PaymentClient();
                $response = $paymentClient->get($id);

                if (!$response) {
                    Log::error('Invalid payment client response');
                    return response()->json(['status' => 'failed'], 400);
                }

                $payment = Payment::where('external_reference', $response->external_reference)->first();

                if (!$payment) {
                    return response()->json('Payment not found', 400);
                }

                return $this->updatePayment($response, $payment);
            } catch (MPApiException $e) {
                Log::error('API Error: ', $e->getApiResponse()->getContent());
                return response()->json(['status' => 'failed'], 400);
            }
        }
    }

    private function createPayment($user, $cart, $external_reference, $amount)
    {
        $payment = new Payment();
        $payment->user()->associate($user);
        $payment->cart()->associate($cart);
        $payment->external_reference = $external_reference;
        $payment->amount = $amount;
        $payment->status = "pending";
        $payment->save();
    }

    private function updatePayment($response, $payment)
    {
        DB::transaction(function () use ($response, $payment) {
            $payment->status = $response->status;
            $payment->payment_id = $response->id;
            $payment->payment_type_id = $response->payment_type_id;
            $payment->save();

            if ($response->status === "approved") {
                $items = CartItem::where('external_reference', $response->external_reference)->get();
                foreach ($items as $item) {
                    $item->paid = 1;
                    $item->save();
                    $product = Product::find($item->product_id);
                    if ($product->type !== "Pizza") {
                        $product->stock = $product->stock - $item->quantity;
                        $product->save();
                    }
                }

                $cart = Cart::find($payment->cart_id);
                if (!$cart) {
                    return response()->json('Cart not found', 400);
                }

                $cart->total = 0;
                $cart->save();
            }
        });

        return response()->json(['status' => 'success']);
    }

    private function processCartItems($items, $external_reference)
    {
        $itemsArray = [];

        foreach ($items as $item) {
            $product = Product::where('id', $item->product_id)->first();
            $item->external_reference = $external_reference;
            $item->save();
            $itemsArray[] = [
                "id" => $product->id,
                "title" => $product->name,
                "quantity" => $item->quantity,
                "unit_price" => (float) $product->price,
                "currency_id" => "BRL",
            ];
        }

        return $itemsArray;
    }
}
