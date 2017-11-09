@extends('layouts.master')
@section('title', 'Notificaciones')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Notificaciones</h2>
            <a class="btn btn-primary" href="{{ route('notifications.create') }}" role="button">Nueva notificación</a>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha de envío</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
                <tr>
                    <td>{{ $notification->id }}</td>
                    <td>{{ $notification->title ?? '-' }}</td>
                    <td>{{ $notification->description }}</td>
                    <td>{{ $notification->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $notifications->links() }}
@endsection