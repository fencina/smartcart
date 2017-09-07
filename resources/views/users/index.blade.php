@extends('layouts.master')
@section('title', 'Operadores')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Operadores</h2>
            <a class="btn btn-primary" href="{{ route('users.create') }}" role="button">Nuevo operador</a>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <i class="fa fa-user" aria-hidden="true" title="Modificar"></i>
                        </a>
                        @if(!$user->isSuperAdmin() AND Auth::user()->id != $user->id)
                            <a href="{{ route('users.delete', $user->id) }}">
                                <i class="fa fa-minus-square" aria-hidden="true" title="Dar de baja"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

@endsection