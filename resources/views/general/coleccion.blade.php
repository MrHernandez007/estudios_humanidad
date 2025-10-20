@extends('layouts.layout_general')

@section('contenido')

<h1 class="mb-4 text-center">{{ $tipoSeleccionado->nombre }}</h1>

<div class="row justify-content-center">
    @forelse($libros as $libro)
        <div class="col-md-5 col-lg-4 mb-4 d-flex align-items-stretch">
            <div class="card w-100 shadow-sm">
                @if($libro->imagen)
                    <img src="{{ Storage::url($libro->imagen) }}" class="card-img-top" style="height:220px; object-fit:cover;" alt="{{ $libro->titulo }}">
                @else
                    <img src="{{ asset('images/default-libro.png') }}" class="card-img-top" style="height:220px; object-fit:cover;" alt="Sin imagen">
                @endif
                <div class="card-body bg-light">
                    <p class="text-muted mb-1">Volumen: {{ $libro->volumen ?? '-' }}</p>
                    <h5 class="card-title fw-semibold">{{ $libro->titulo }}</h5>
                    {{-- <p class="card-text mb-2">
                        <strong>Autores:</strong> 
                    {{ $libro->autores
                        ->filter(fn($a) => $a->pivot->rol !== 'autor_libro')
                        ->map(fn($a) => $a->nombre . ' ' . $a->apellido . ' (' . $a->pivot->rol . ')')
                        ->join(', ') 
                        ?: '-' 
                    }} <br>

                        <strong>¿Cómo citar?</strong> {{ $libro->cita ?? '-' }} <br>
                        <strong>Serie:</strong> {{ $libro->serie->nombre ?? '-' }}
                    </p> --}}
                    <p class="card-text mb-2">
                        <strong>Autores:</strong>
                        {{ $libro->autores->map(function($a) {
                            // Si el rol es 'autor_libro', sólo mostrar el nombre completo
                            if ($a->pivot->rol === 'autor_libro') {
                                return $a->nombre . ' ' . $a->apellido;
                            } else {
                                // Si es otro tipo de autor, incluir el rol entre paréntesis
                                return $a->nombre . ' ' . $a->apellido . ' (' . $a->pivot->rol . ')';
                            }
                        })->join(', ') ?: '-' }}
                        <br>

                        <strong>¿Cómo citar?</strong> {{ $libro->cita ?? '-' }} <br>

                        @if(!empty($libro->serie?->nombre))
                            <strong>Serie:</strong> {{ $libro->serie->nombre }}
                        @endif
                    </p>

                    <a href="{{ route('general.libro.detalle', $libro->id) }}" class="btn btn-primary w-100">Detalles</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>No hay libros para este tipo.</p>
        </div>
    @endforelse
</div>

@endsection
