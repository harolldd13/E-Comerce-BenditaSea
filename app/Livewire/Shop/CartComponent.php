<?php

namespace App\Livewire\Shop;

use Livewire\Component;

class CartComponent extends Component
{
    public $cart;
    protected $listeners = ['add_to_cart'];

    public function productAdded()
{
    // Aquí puedes realizar cualquier acción necesaria cuando se agrega un producto al carrito
}

    public function render()
    {
        

        return view('livewire.shop.cart-component');
    }
}
