@extends('layouts.master')
@section('title', 'Operadores')

@section('content')
    <h2>Crear operador</h2>

    {{ Form::open(['route' => ['users.store'], 'class' => 'form-horizontal']) }}
        @include('users.fields')
    {{ Form::close() }}

@endsection