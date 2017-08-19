<div class="form-group">
    {{ Form::label('name', 'Nombre', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['class' => 'form-control col-sm-10', 'placeholder' => 'Nombre']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('last_name', 'Apellido', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('last_name', null, ['class' => 'form-control col-sm-10', 'placeholder' => 'Apellido']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('file_number', 'Legajo', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('file_number', null, ['class' => 'form-control col-sm-10', 'placeholder' => 'Legajo']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('email', null, ['class' => 'form-control col-sm-10', 'placeholder' => 'Email']) }}
    </div>
</div>
@if(!isset($user))
    <div class="form-group">
        {{ Form::label('password', 'Contraseña', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::text('password', null, ['class' => 'form-control col-sm-10', 'placeholder' => 'Contraseña']) }}
        </div>
    </div>
@endif
<div class="form-group">
    {{ Form::label('role_id', 'Rol', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('role_id', $roles->prepend('Seleccionar rol', '0'), null, ['class' => 'form-control col-sm-10']) }}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Guardar</button>
    </div>
</div>