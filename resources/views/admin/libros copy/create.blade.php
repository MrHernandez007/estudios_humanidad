@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Nuevo Libro</h2>

    <form action="{{ route('admin.libros.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="volumen" class="form-label">Volumen</label>
            <input type="text" name="volumen" id="volumen" class="form-control">
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" name="anio" id="anio" class="form-control">
        </div>

        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen</label>
            <textarea name="resumen" id="resumen" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="cita" class="form-label">Cita</label>
            <textarea name="cita" id="cita" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control">
        </div>

        <div class="mb-3">
            <label for="isbn_coleccion" class="form-label">ISBN de la colección</label>
            <input type="text" name="isbn_coleccion" id="isbn_coleccion" class="form-control">
        </div>

        <div class="mb-3">
            <label for="palabras_clave" class="form-label">Palabras clave</label>
            <textarea name="palabras_clave" id="palabras_clave" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="resena" class="form-label">Reseña</label>
            <textarea name="resena" id="resena" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento (texto o URL)</label>
            <textarea name="documento" id="documento" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="serie" class="form-label">Serie</label>
            <select name="series_id" id="serie" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($series as $serie)
                    <option value="{{ $serie->id }}">{{ $serie->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">💾 Guardar</button>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">⬅️ Volver</a>
    </form>
</div>
@endsection
