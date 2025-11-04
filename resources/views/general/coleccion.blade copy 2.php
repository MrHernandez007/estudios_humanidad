@extends('layouts.layout_general')

@section('contenido')

<h1 class="mb-4 text-center">{{ $tipoSeleccionado->nombre }}</h1>

<div class="row justify-content-center">
    @forelse($libros as $libro)
        <div class="col-md-5 col-lg-4 mb-4 d-flex align-items-stretch">
            <div class="card w-100 shadow-sm d-flex flex-column" style="border: none;">

                {{-- Imagen del libro --}}
                @if($libro->imagen)
                    <img src="{{ Storage::url($libro->imagen) }}" 
                         class="card-img-top" 
                         style="height: 320px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;" 
                         alt="{{ $libro->titulo }}">
                @else
                    <img src="{{ asset('images/default-libro.png') }}" 
                         class="card-img-top" 
                         style="height: 320px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;" 
                         alt="Sin imagen">
                @endif

                {{-- Contenido --}}
                <div class="card-body bg-light d-flex flex-column justify-content-between" 
                     style="flex-grow: 1; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">

                    <div>
                        {{-- Volumen --}}
                        <p class="mb-1" style="color: #000;">
                            <strong>Volumen {{ $libro->volumen ?? '-' }}</strong>
                        </p>

                        {{-- Título --}}
                        <h5 class="card-title fw-bold mb-3" style="color: #000;">
                            {{ $libro->titulo }}
                        </h5>

                        {{-- Autores --}}
                        <p class="mb-2" style="font-size: 0.95rem;">
                            <strong>Autores:</strong><br>
                            {{ $libro->autores->map(function($a) {
                                return $a->pivot->rol === 'autor_libro'
                                    ? $a->nombre . ' ' . $a->apellido
                                    : $a->nombre . ' ' . $a->apellido . ' (' . $a->pivot->rol . ')';
                            })->join(', ') ?: '-' }}
                        </p>

                        {{-- Cita --}}
                        <p class="mb-2" style="font-size: 0.95rem;">
                            <strong>¿Cómo citar?</strong><br>
                            {{ $libro->cita ?? '-' }}
                        </p>

                        {{-- Serie --}}
                        @if(!empty($libro->serie?->nombre))
                            <p class="mb-3" style="font-size: 0.95rem;">
                                <strong>Serie:</strong> {{ $libro->serie->nombre }}
                            </p>
                        @endif
                    </div>

                    {{-- Botón Detalles --}}
                    <div class="mt-auto">
                        <a href="{{ route('general.libro.detalle', $libro->id) }}" 
                           class="btn w-100 fw-semibold text-white" 
                           style="background-color: #FF6F00; border: none; transition: 0.3s;">
                           Detalles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>No hay libros para este tipo.</p>
        </div>
    @endforelse
</div>

{{-- Estilos adicionales --}}
<style>
.card {
    min-height: 600px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.card-body p {
    color: #333;
    line-height: 1.4;
}
.btn:hover {
    background-color: #e05f00 !important;
}
</style>

@endsection
