@extends('layouts.layout_general')

@section('contenido')

{{-- Hero de convocatoria --}}
{{-- <section class="text-center py-5"> --}}
    <section class="text-center py-5 bg-light">

    <div class="container">
        <h1 class="display-5 fw-bold">{{ $publicacion->titulo }}</h1>
        <p class="lead text-muted">{{ $publicacion->tipo }}</p>
        <small class="text-muted">{{ \Carbon\Carbon::parse($publicacion->fecha)->format('d M, Y') }}</small>
    </div>
</section>

{{-- Contenido principal --}}
<section class="container my-5">
    <div class="row justify-content-center align-items-center" style="max-width: 1200px; margin: auto;">

        {{-- Columna de texto --}}
        <div class="col-md-6 d-flex flex-column justify-content-start">
            <h3 class="fw-bold">Descripción</h3>
            <p class="text-muted">{{ $publicacion->descripcion }}</p>

            @if($publicacion->archivo_bases)
                <a href="{{ asset('storage/' . $publicacion->archivo_bases) }}" class="btn btn-primary mt-3" download>
                    📥 Descargar bases
                </a>
            @endif
        </div>

        {{-- Columna de imagen opcional --}}
        @if($publicacion->imagen)
            <div class="col-md-6 d-flex align-items-center justify-content-center mt-3 mt-md-0">
                <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="img-fluid rounded shadow" alt="Imagen de {{ $publicacion->titulo }}">
            </div>
        @endif

    </div>
</section>

{{-- Información adicional (opcional) --}}
@if($publicacion->requisitos || $publicacion->notas)
<section class="container my-5">
    @if($publicacion->requisitos)
        <h3 class="fw-bold">Requisitos</h3>
        <p class="text-muted">{{ $publicacion->requisitos }}</p>
    @endif

    @if($publicacion->notas)
        <h3 class="fw-bold mt-4">Notas importantes</h3>
        <p class="text-muted">{{ $publicacion->notas }}</p>
    @endif
</section>
@endif

@endsection
