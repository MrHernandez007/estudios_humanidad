@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Editar Administrador</h2>

    <form action="{{ route('admin.administradores.update', $administrador) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $administrador->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $administrador->email }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ $administrador->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$administrador->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="rol_id" class="form-label">Rol</label>
            <select name="rol_id" id="rol_id" class="form-select" required>
                <option value="1" {{ $administrador->rol_id == 1 ? 'selected' : '' }}>Superadmin</option>
                <option value="2" {{ $administrador->rol_id == 2 ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña (dejar en blanco si no cambia)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-success">💾 Actualizar</button>
        <a href="{{ route('admin.administradores.index') }}" class="btn btn-secondary">⬅️ Volver</a>
    </form>
</div>
@endsection
