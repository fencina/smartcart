@extends('layouts.master')
@section('title', 'Compras')

@section('content')

    <div class="container">
        @if($purchase)
            <table class="table table-hover">
                <thead>
                    <th>Nombre</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Sub Total</th>
                </thead>
                <tbody>
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
                </tbody>
            </table>

            {!! Form::open(['route' => ['purchases.confirm', $purchase]]) !!}
                <button type="submit" class="btn btn-info">Confirmar compra</button>
            {!! Form::close() !!}
        @else
           <p>Esperando una compra...</p>
        @endif
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