@extends('layouts.master')
@section('title', 'Operadores')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <h2>Modificar operador</h2>

    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ $operador->email }}" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" id="inputName" placeholder="Nombre" value="{{ $operador->name }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputLastName" class="col-sm-2 control-label">Apellido</label>
            <div class="col-sm-10">
                <input type="last_name" class="form-control" id="inputLastName" placeholder="Apellido" value="{{ $operador->last_name }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Guardar</button>
            </div>
        </div>
    </form>

@endsection