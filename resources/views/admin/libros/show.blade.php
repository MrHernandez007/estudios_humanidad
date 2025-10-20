@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>{{ $libro->titulo }}</h2>

    <p><strong>Volumen:</strong> {{ $libro->volumen }}</p>
    <p><strong>Año:</strong> {{ $libro->anio }}</p>
    <p><strong>Resumen:</strong> {{ $libro->resumen }}</p>
    <p><strong>Cita:</strong> {{ $libro->cita }}</p>
    <p><strong>ISBN:</strong> {{ $libro->isbn }}</p>
    <p><strong>ISBN Colección:</strong> {{ $libro->isbn_coleccion }}</p>
    <p><strong>Palabras clave:</strong> {{ $libro->palabras_clave }}</p>
    <p><strong>Reseña:</strong> {{ $libro->resena }}</p>
    <p><strong>Documento:</strong> {{ $libro->documento }}</p>
    <p><strong>Documento:</strong> {{ $libro->pdf }}</p>
    <p><strong>Serie:</strong> {{ $libro->serie->nombre ?? '-' }}</p>

    @if($libro->imagen)
        <p><img src="{{ asset('storage/'.$libro->imagen) }}" alt="{{ $libro->titulo }}" width="150"></p>
    @endif
    

    <p><strong>Estado:</strong> {{ $libro->estado ? 'Activo' : 'Inactivo' }}</p>

    <h4>Autores / Coordinadores / Presentadores</h4>
    <ul>
        @foreach($libro->autores as $a)
            <li>{{ $a->nombre }} {{ $a->apellido }} — <em>{{ $a->pivot->rol }}</em></li>
        @endforeach
    </ul>

    <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">⬅️ Volver</a>
</div>
@endsection


