@extends('layouts.master')
@section('title', 'Notificaciones')

@section('content')
    <h2>Enviar notificación</h2>

    {{ Form::open(['route' => ['notifications.store'], 'class' => 'form-horizontal']) }}
    <div class="form-group">
        {{ Form::label('title', 'Título', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::text('title', null, ['class' => 'form-control col-sm-10', 'placeholder' => 'Título']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Descripción', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::textarea('description', null, ['class' => 'form-control col-sm-10', 'placeholder' => 'Ingrese el texto de la notificación']) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Enviar</button>
        </div>
    </div>
    {{ Form::close() }}

@endsection