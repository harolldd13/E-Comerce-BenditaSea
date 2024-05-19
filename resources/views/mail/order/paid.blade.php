<x-mail::message>
# Introduction

aqui esta tu recibo 
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>cantidad</th>
            <th>precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items  as $item)
        <tr>
            <td scope="row">{{$item->name}}</td>
            <td >{{$item->pivot->qty}}</td>
            <td >{{$item->pivot->price}}</td>
        </tr>
            
        @endforeach
    </tbody>

</table>

Total: $ {{$order->total}}
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
