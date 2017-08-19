@extends('layouts.master')
@section('title', 'Operadores')

@section('content')
    <h2>Modificar operador</h2>

    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
        @include('users.fields')
    {{ Form::close() }}

@endsection