{{-- <div>
      <a href="{{route('cart')}}" class="btn btn-primary"></a>
      <i class="fas fa-shopping-cart"></i>
       {{ Cart::count() }}
</div> --}}
<div>
      <a href="{{route('cart')}}" class="btn btn-primary">
          <i class="fas fa-shopping-cart"></i>
          @auth
          {{ $cartCount }}
          
              
          @else
              0
          @endauth
        
      </a>
  </div>