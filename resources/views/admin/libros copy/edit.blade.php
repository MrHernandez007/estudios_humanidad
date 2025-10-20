@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Editar Libro</h2>

    <form action="{{ route('admin.libros.update', $libro) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $libro->titulo }}" required>
        </div>

        <div class="mb-3">
            <label for="volumen" class="form-label">Volumen</label>
            <input type="text" name="volumen" id="volumen" class="form-control" value="{{ $libro->volumen }}">
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" name="anio" id="anio" class="form-control" value="{{ $libro->anio }}">
        </div>

        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen</label>
            <textarea name="resumen" id="resumen" class="form-control">{{ $libro->resumen }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cita" class="form-label">Cita</label>
            <textarea name="cita" id="cita" class="form-control">{{ $libro->cita }}</textarea>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ $libro->isbn }}">
        </div>

        <div class="mb-3">
            <label for="isbn_coleccion" class="form-label">ISBN de la colección</label>
            <input type="text" name="isbn_coleccion" id="isbn_coleccion" class="form-control" value="{{ $libro->isbn_coleccion }}">
        </div>

        <div class="mb-3">
            <label for="palabras_clave" class="form-label">Palabras clave</label>
            <textarea name="palabras_clave" id="palabras_clave" class="form-control">{{ $libro->palabras_clave }}</textarea>
        </div>

        <div class="mb-3">
            <label for="resena" class="form-label">Reseña</label>
            <textarea name="resena" id="resena" class="form-control">{{ $libro->resena }}</textarea>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento (texto o URL)</label>
            <textarea name="documento" id="documento" class="form-control">{{ $libro->documento }}</textarea>
        </div>

        <div class="mb-3">
            <label for="serie" class="form-label">Serie</label>
            <select name="series_id" id="serie" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($series as $serie)
                    <option value="{{ $serie->id }}" {{ $libro->series_id == $serie->id ? 'selected' : '' }}>{{ $serie->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            @if($libro->imagen)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$libro->imagen) }}" alt="{{ $libro->titulo }}" width="120">
                </div>
            @endif
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ $libro->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$libro->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">💾 Actualizar</button>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">⬅️ Volver</a>
    </form>
</div>
@endsection
