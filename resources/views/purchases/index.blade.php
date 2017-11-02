@extends('layouts.master')
@section('title', 'Compras')

@section('content')

    <table class="table table-hover">
        <thead>
            <th>Nombre</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Sub Total</th>
        </thead>
        <tbody>
        @if($purchase)
            @foreach($purchase->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ "$$product->price" }}</td>
                    <td>{{ $product->pivot->count }}</td>
                    <td>{{ '$'.$product->price * $product->pivot->count }}</td>
                </tr>

                @if($loop->last)
                    <tr style="background-color: lightgreen">
                        <td></td>
                        <td></td>
                        <td style="text-align: right">Total:</td>
                        <td>{{ '$'.$purchase->amounts }}</td>
                    </tr>
                @endif
            @endforeach
        @else
            <tr>
               <td colspan="4">Esperando una compra...</td>
            </tr>
        @endif
        </tbody>
    </table>

    <div>
        {!! QrCode::size(100)->generate('www.google.com.ar') !!}
        <p>Escaneame!!!!!</p>
    </div>

    <script>
        $(document).ready( function() {
            Echo.private('new-purchase')
                .listen('PurchaseCreated', (e) => {
                location.reload();
            })
        })
    </script>

@endsection