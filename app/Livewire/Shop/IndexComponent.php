<?php
namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Cart;

class IndexComponent extends Component
{
    public function render()
    {
        $products = Product::take(20)->get();
        return view('livewire.shop.index-component', compact('products'))->extends('layouts.app')->section('content');
    }
    
    public function add_to_cart(Product $product)
    {  
        // Agregar el producto al carrito
        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => 1,
            'attributes' => [],
            'associatedModel' => $product,
        ]);
        
        // Emitir el evento para indicar que el carrito ha sido actualizado
        event('cartUpdated');
    }
}