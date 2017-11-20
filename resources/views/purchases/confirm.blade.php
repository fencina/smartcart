@extends('layouts.master')
@section('title', 'Compras')

@section('content')


    <div class="container-qr">
        {!! QrCode::size(300)->generate( $purchase->id ) !!}
        <p style="font-size: xx-large;font-weight: bold;color: darkblue;">¡Confirmá tu compra!</p>
    </div>


    <script>
        $(document).ready( function() {
            Echo.private('purchase-associated')
                .listen('PurchaseAssociated', (e) => {
                window.location.replace("{{ url('purchases') }}");
        })
        })
    </script>

@endsection