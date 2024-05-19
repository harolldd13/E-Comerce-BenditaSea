<?php


namespace App\Livewire\Shop;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public $cartCount;

    protected $listeners = ['cartUpdated'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function cartUpdated()
    {
        $this->updateCartCount();
    }

    // Método para actualizar el conteo del carrito
    public function updateCartCount()
    {
        // Actualizar el carrito y obtener el conteo actualizado
        $this->cartCount = Cart::count();
    }

    public function render()
    {
        return view('livewire.shop.cart-component');
    }
}
