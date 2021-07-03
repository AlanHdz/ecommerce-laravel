<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CartManager;

class Checkout extends Component
{

    public $cart, $stripeKey;

    public function mount(CartManager $cart)
    {
        $this->stripeKey = config('services.stripe.key');
        $this->cart = $cart->getCart();
    }

    public function deleteProduct(CartManager $cart, $productId)
    {
        $cart->deleteProduct($productId);
        session()->flash('message', 'Producto removido');
        $this->emitTo('cart', 'addToCart');
    }

    public function hydrate()
    {
        $this->cart = (app(CartManager::class))->getCart();
    }

    public function render()
    {
        return view('livewire.checkout', [
            'products' => $this->cart->products
        ])->extends('layouts.app');
    }
}
