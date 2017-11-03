@extends('layouts.master')
@section('title', 'Com')

@section('content')


    <div>
        {!! QrCode::size(100)->generate( $purchase->id ) !!}
        <p>¡Confirmá tu compra!</p>
    </div>

@endsection