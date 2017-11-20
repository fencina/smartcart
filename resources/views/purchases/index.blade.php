@extends('layouts.master')
@section('title', 'Compras')

@section('content')

    @php
        $montoTotal = 0;
    @endphp

    <div class="container">
        @if($purchase)
            <table id="productsTable" class="table table-hover">
                <thead>
                    <th>Nombre</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Sub Total</th>
                </thead>
                <tbody>

                @foreach($purchase->products as $product)
                    <tr id="{{$product->id}}">
                        <td>{{ $product->name }}</td>
                        <td>{{ "$$product->price" }}</td>
                        <td>{{ $product->pivot->count }}</td>
                        <td>{{ '$' . number_format($product->price * $product->pivot->count, 2) }}</td>
                        @php
                            $montoTotal += $product->price * $product->pivot->count;
                        @endphp
                        <td>
                            <button onclick='borrarProducto({{$product->id}})'>
                                <i class="fa fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr>

                    @if($loop->last)
                        <tr style="background-color: darkgreen">
                            <td></td>
                            <td></td>
                            <td style="text-align: right; font-weight: bold; color: white;">Total:</td>
                            <td style="font-weight: bold; color: white;" id="montoTotal">{{'$'.$montoTotal}}</td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

            {!! Form::open(['route' => ['purchases.confirm', $purchase]]) !!}
                <input type="hidden" name="finalProducts">
                <button class="btn btn-info" onclick="confirmarCompra(event);">Confirmar compra</button>
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


        function borrarProducto($variable){
            var montoTotal = $('#montoTotal').text();
            montoTotal = montoTotal.substring(1, montoTotal.length)
            var cantidad = jQuery("#"+$variable).find("td:eq(2)").text();
            var precio = jQuery("#"+$variable).find("td:eq(1)").text();
            precio = precio.substring(1, precio.length);
            var precioProducto = cantidad * precio;
            montoTotal -= precioProducto;
            $('#montoTotal').text("$"+montoTotal);
            $("#"+$variable).remove();
        }

        function confirmarCompra(e){
            e.preventDefault();
            construirCompraJson();
            $('form').submit();
        }

        function construirCompraJson(){
            var products = [];

            $("#productsTable tbody tr").each(function (index, row) {
                product = {};
                product.id = $(row).attr('id');
                product.count = $(row).find("td:eq(2)").text();

                products.push(product);
            });

            products.pop();
            products = JSON.stringify(products);
            $("[name='finalProducts']").val(products);
        }

    </script>

@endsection