@extends('layouts.master')
@section('title', 'Compras')

@section('content')

<table class="table table-hover">
</table>

<div>
    {!! QrCode::size(100)->generate('www.google.com.ar'); !!}
    <p>Escaneame!!!!!</p>
</div>

@endsection