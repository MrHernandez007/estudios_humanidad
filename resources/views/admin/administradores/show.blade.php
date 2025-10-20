@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Administrador</h2>

    <div class="card p-4">
        <h3>{{ $administradores->name }}</h3>
        <p><strong>Correo:</strong> {{ $administradores->email }}</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $administradores->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $administradores->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>
        <p><strong>Rol:</strong>
            <span class="badge {{ $administradores->rol_id == 1 ? 'bg-primary' : 'bg-secondary' }}">
                {{ $administradores->rol_id == 1 ? 'Superadmin' : 'Admin' }}
            </span>
        </p>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.administradores.edit', $administradores) }}" class="btn btn-warning">✏️ Editar</a>
        <a href="{{ route('admin.administradores.index') }}" class="btn btn-secondary">⬅️ Volver</a>
    </div>
</div>
@endsection
