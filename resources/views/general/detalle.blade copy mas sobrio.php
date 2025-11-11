@extends('layouts.layout_general')

@section('contenido')
<div style="font-family: 'Cambria', serif; background-color:#FFFFFF; min-height:100vh;">

<div class="container my-5">

    {{-- Título del libro --}}
    <h1 class="mb-4 fw-bold text-center" style="color:#000000;">
        {{ $libro->titulo }}
    </h1>

    {{-- Imagen del libro --}}
    <div class="text-center mb-5">
        <img src="{{ Storage::url($libro->imagen) }}" 
             alt="{{ $libro->titulo }}" 
             class="img-fluid rounded" 
             style="max-height: 450px; object-fit: cover;">
    </div>

    {{-- Información general --}}
    <div class="mb-5">
        <h4 class="fw-bold mb-4" style="color:#000;">Información del libro</h4>

        @php
            $roles = [
                'autor_libro' => 'Autor', 
                'coordinador' => 'Coordinador',
                'editor' => 'Editor', 
                'presentador' => 'Presentador', 
                'compilador' => 'Compilador'
            ];
        @endphp

        @foreach($roles as $clave => $nombreRol)
            @php
                $autoresPorRol = $libro->autores->filter(fn($a) => in_array($clave, explode(',', $a->pivot->rol)));
            @endphp
            @if($autoresPorRol->isNotEmpty())
                <p><strong>{{ $nombreRol }}:</strong> 
                <span>{{ $autoresPorRol->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}</span></p>
            @endif
        @endforeach

        @if($libro->serie)
            <p><strong>Serie:</strong> <span>{{ $libro->serie->nombre }}</span></p>
        @endif

        <p><strong>Volumen:</strong> <span>{{ $libro->volumen }}</span></p>
        <p><strong>Año:</strong> <span>{{ $libro->anio }}</span></p>

        <p><strong>Resumen:</strong></p>
        <p style="text-align: justify; line-height:1.8;">
            {!! nl2br(e($libro->resumen)) !!}
        </p>

        @if(!empty($libro->palabras_clave))
            <p><strong>Palabras clave:</strong> 
                <span>{{ $libro->palabras_clave }}</span>
            </p>
        @endif

        <p><strong>ISBN:</strong> <span>{{ $libro->isbn }}</span></p>

        @if(!empty($libro->isbn_coleccion))
            <p><strong>ISBN colección:</strong> <span>{{ $libro->isbn_coleccion }}</span></p>
        @endif

        @if(!empty($libro->cita))
            <p><strong>¿Cómo citar?:</strong> 
                <span>{{ $libro->cita }}</span></p>
        @endif

        @if($libro->pdf)
            <p>
                <strong>Documento:</strong> 
                <a href="{{ asset('storage/' . $libro->pdf) }}" 
                   target="_blank" 
                   class="btn btn-sm text-white"
                   style="background-color:#000000; border:none;">
                   Ver PDF
                </a>
            </p>
        @endif
    </div>

    {{-- Contenido del libro --}}
    <div>
        <h4 class="fw-bold mb-4" style="color:#000;">Contenido del libro</h4>

        @foreach($libro->capitulos as $index => $capitulo)
            <h5 class="fw-bold mb-2">{{ $capitulo->nombre }}</h5>

            @if($capitulo->autores->isNotEmpty())
                <p><strong>Autor(es):</strong> 
                <span>{{ $capitulo->autores->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}</span></p>
            @endif

            @php
                $lineas = explode("\n", $capitulo->descripcion);
            @endphp
            @foreach($lineas as $linea)
                @if(trim($linea) !== '')
                    <p style="text-indent: 2em; text-align: justify; line-height: 1.8;">
                        {{ $linea }}
                    </p>
                @endif
            @endforeach

            {{-- Cita del capítulo con collapse --}}
            @if($capitulo->cita_articulo)
                @php $collapseId = 'citaCapitulo' . $index; @endphp

                <div class="my-3">
                    <button class="btn btn-outline-dark btn-sm" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#{{ $collapseId }}" 
                            aria-expanded="false" 
                            aria-controls="{{ $collapseId }}">
                        Ver cita
                    </button>

                    <div class="collapse mt-3" id="{{ $collapseId }}">
                        <div style="border-left:4px solid #000; padding-left:15px;">
                            <em>{{ $capitulo->cita_articulo }}</em>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(btn => {
    const target = document.querySelector(btn.dataset.bsTarget);
    if (target) {
      target.addEventListener('show.bs.collapse', () => btn.textContent = 'Ocultar cita');
      target.addEventListener('hide.bs.collapse', () => btn.textContent = 'Ver cita');
    }
  });
});
</script>

</div>
@endsection
