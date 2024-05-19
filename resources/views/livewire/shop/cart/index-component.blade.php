<div>
    <div class="container">
      
      
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio </th>
                  
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart_items->sortBy('id') as $item)
                    <tr class="">
                        <td>{{$item->name}}</td>
                        <td>
                            <input type="number" 
                                   id="v_{{ $item->id }}"
                                   class="form-control" 
                                   value="{{ $item->qty }}"
                                   wire:change="updateQty('{{ $item->id }}', $event.target.value)">
                        </td>
                       
                        <td>{{ $item->price * $item->qty }}</td>


                      
                        <td>
                            <button type="button" 
                            wire:click="delete_item('{{ $item->id }}')" 
                            class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>
            <h3>Total:$ {{Cart::total()}}  </h3>
            <a href="{{route('checkout')}}" class="btn btn-primary"> pagar</a>
  
        

    </div>
 
       

</div>
