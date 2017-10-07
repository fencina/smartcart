@extends('layouts.master')
@section('title', 'Operadores')

@section('content')
    <h2>Restaurar operador</h2>

    <div class="jumbotron text-center">
        <h3>¿Desea restaurar el operador {{ $user->name . ' ' . $user->last_name }} ?</h3>

        {{ Form::open(['route' => ['users.restore', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
            <button type="submit" class="btn btn-success">Restaurar</button>
        {{ Form::close() }}
    </div>


@endsection