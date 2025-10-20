@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Detalles del Libro</h2>

    <div class="card p-4">
        <h3>{{ $libro->titulo }}</h3>
        
        @if($libro->imagen)
            <img src="{{ asset('storage/'.$libro->imagen) }}" alt="{{ $libro->titulo }}" width="180" class="mb-3">
        @endif

        <p><strong>Volumen:</strong> {{ $libro->volumen ?? '-' }}</p>
        <p><strong>Año:</strong> {{ $libro->anio ?? '-' }}</p>
        <p><strong>Serie:</strong> {{ $libro->serie->nombre ?? 'N/A' }}</p>
        <p><strong>Resumen:</strong> {{ $libro->resumen ?? 'Sin resumen' }}</p>
        <p><strong>Cita:</strong> {{ $libro->cita ?? '-' }}</p>
        <p><strong>ISBN:</strong> {{ $libro->isbn ?? '-' }}</p>
        <p><strong>ISBN de la colección:</strong> {{ $libro->isbn_coleccion ?? '-' }}</p>
        <p><strong>Palabras clave:</strong> {{ $libro->palabras_clave ?? '-' }}</p>
        <p><strong>Reseña:</strong> {{ $libro->resena ?? '-' }}</p>
        <p><strong>Documento:</strong> {{ $libro->documento ?? '-' }}</p>
        <p><strong>Estado:</strong>
            <span class="badge {{ $libro->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $libro->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </p>

        <p><strong>Creado en:</strong> {{ $libro->created_at }}</p>
        <p><strong>Actualizado en:</strong> {{ $libro->updated_at }}</p>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.libros.edit', $libro) }}" class="btn btn-warning">✏️ Editar</a>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">⬅️ Volver</a>
    </div>
</div>
@endsection
