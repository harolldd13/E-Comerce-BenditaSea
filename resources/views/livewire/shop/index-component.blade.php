<div>
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('prueba.jpg') }}" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary" wire:click="add_to_cart({{ $product->id }})">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

