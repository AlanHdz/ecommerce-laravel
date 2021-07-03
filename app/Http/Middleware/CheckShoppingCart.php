<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CartManager;

class CheckShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $cart = app(CartManager::class);

        if (is_null($cart->getCart()) || $cart->getCart()->amount() == 0 ) {
            return redirect('/');
        }

        return $next($request);
    }
}
