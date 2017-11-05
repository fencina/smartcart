@extends('layouts.master')
@section('title', 'Compras')

@section('content')


    <div>
        {!! QrCode::size(100)->generate( $purchase->id ) !!}
        <p>¡Confirmá tu compra!</p>
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