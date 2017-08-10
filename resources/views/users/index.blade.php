@extends('layouts.master')
@section('title', 'Operadores')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <h2>Operadores</h2>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.update', $user->id) }}">
                            <i class="fa fa-user" aria-hidden="true" title="modificar"></i>
                        </a>
                        <a href="https://www.google.com.ar">
                            <i class="fa fa-minus-square" aria-hidden="true" title="dar de baja"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a class="btn btn-primary" href="{{ route('users.create') }}" role="button">Crear nuevo usuario</a>

@endsection