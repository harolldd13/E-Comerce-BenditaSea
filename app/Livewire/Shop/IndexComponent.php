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
    public function add_to_cart(Product $product) {
      
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => 1, // Agrega la cantidad deseada
            'attributes' => array(), // Puedes añadir atributos personalizados aquí
            'associatedModel' => $product, // Asocia el modelo del producto
        ]);
       $this->dispatch('productAdded', ['message' => 'Producto agregado correctamente']);

       
        // $this->emit('productAdded');

    }
  

}

