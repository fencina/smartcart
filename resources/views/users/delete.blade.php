@extends('layouts.master')
@section('title', 'Operadores')

@section('content')
    <h2>Eliminar operador</h2>

    <div class="jumbotron text-center">
        <h3>¿Desea eliminar el operador {{ $user->name . ' ' . $user->last_name }} ?</h3>

        {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) }}
            <button type="button" class="btn btn-default" onclick="window.history.back()">Volver</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        {{ Form::close() }}
    </div>


@endsection