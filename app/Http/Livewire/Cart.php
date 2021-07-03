<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CartManager;

class Cart extends Component
{

    public $cart;

    protected $listeners = ['addToCart'];

    public function mount(CartManager $cart)
    {
        $this->cart = $cart->getCart();
    }

    public function addToCart()
    {
        
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
