<?php

namespace App\Livewire\Shop\Cart;
use App\Models\Product;

use Cart;
use Livewire\Component;

    

class IndexComponent extends Component
{
    public function render()
    {
        $cart_items = Cart::content(); // Obtener los elementos del carrito
        return view('livewire.shop.cart.index-component', compact('cart_items'))
            ->extends('layouts.app')
            ->section('content');
    }

    public function update_qty ($itemId, $qty){
        Cart::update();


    }
    public function delete_item($itemId)
    {
        $cartItems = Cart::content();
        
        // Buscar el rowId correspondiente al itemId
        $item = $cartItems->where('id', $itemId)->first();

        if ($item) {
            Cart::remove($item->rowId);
        }
    }
    
}