<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paypal;
use App\Models\CartManager;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function paypalPaymentRequest(CartManager $cart, Paypal $paypal)
    {
        return redirect()->away($paypal->paymentRequest($cart->getAmount()));
    }

    public function paypalCheckout(Request $request, CartManager $cart, Paypal $paypal, $status)
    {
        if ($status == "success") {
            $response = $paypal->checkout($request);

            if(!is_null($response)) {
                $response->shopping_cart_id = $cart->getCart()->id;
                Order::createFromResponse($response);
                session()->flash('message', 'Compra exitosa, hemos enviado un correo con un resumen de tu compra');
                return redirect()->route('welcome');
            }
        }
    }

    public function stripeCheckout(Request $request, CartManager $cart)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        Charge::create([
            'amount' => ($cart->getAmount()),
            'currency' => 'USD',
            'source' => $request->stripeToken
        ]);
        
        Order::create(['shopping_cart_id' => $cart->getCart()->id, 'email' => $request->email]);

        session()->flash('message', 'Compra exitosa, hemos enviado un correo con un resumen de tu compra');
        return redirect()->route('welcome');

    }
}
