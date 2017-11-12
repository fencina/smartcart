@extends('layouts.master')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-3">¡ Bienvenido {{ Auth::user()->name }} !</h1>
        <hr class="my-4">
        <img src="{{ asset('storage/img/logo.png') }}">
    </div>
@stop