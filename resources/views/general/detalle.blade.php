@extends('layouts.layout_general')

@section('contenido')
<div style="font-family: 'Cambria', serif; background-color:#FFFFFF; min-height:100vh;">

<div class="container my-5">

    {{-- Título del libro --}}
    <h1 class="mb-4 fw-bold text-center" style="color:#000; font-size:2rem; letter-spacing:0.5px;">
        {{ $libro->titulo }}
    </h1>

    {{-- Imagen del libro --}}
    <div class="text-center mb-5">
        <img src="{{ Storage::url($libro->imagen) }}" 
             alt="{{ $libro->titulo }}" 
             class="img-fluid rounded" 
             style="max-height: 420px; object-fit: cover;">
    </div>

    {{-- Información general --}}
    <div class="mb-5 pb-4" style="border-bottom:1px solid #E0E0E0;">
        <h4 class="fw-bold mb-4" style="color:#000; font-size:1.3rem;">
            Información general
        </h4>

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
                <p class="mb-1">
                    <strong>{{ $nombreRol }}:</strong> 
                    <span>{{ $autoresPorRol->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}</span>
                </p>
            @endif
        @endforeach

        @if($libro->serie)
            <p class="mb-1"><strong>Serie:</strong> {{ $libro->serie->nombre }}</p>
        @endif

        <p class="mb-1"><strong>Volumen:</strong> {{ $libro->volumen }}</p>
        <p class="mb-1"><strong>Año:</strong> {{ $libro->anio }}</p>

        @if(!empty($libro->resumen))
            <p class="mt-4 mb-2 fw-bold">Resumen</p>
            <p style="text-align: justify; line-height:1.8; font-size:1rem;">
                {!! nl2br(e($libro->resumen)) !!}
            </p>
        @endif

        @if(!empty($libro->palabras_clave))
            <p class="mt-4 mb-1"><strong>Palabras clave:</strong> {{ $libro->palabras_clave }}</p>
        @endif

        <p class="mb-1"><strong>ISBN:</strong> {{ $libro->isbn }}</p>

        @if(!empty($libro->isbn_coleccion))
            <p class="mb-1"><strong>ISBN colección:</strong> {{ $libro->isbn_coleccion }}</p>
        @endif

        @if(!empty($libro->cita))
            <p class="mb-1"><strong>¿Cómo citar?:</strong> {{ $libro->cita }}</p>
        @endif

        @if($libro->pdf)
            <div class="mt-3">
                <a href="{{ asset('storage/' . $libro->pdf) }}" 
                   target="_blank" 
                   class="btn btn-dark btn-sm px-4">
                   Ver PDF
                </a>
            </div>
        @endif
    </div>

    {{-- Contenido del libro --}}
    <div class="pt-3">
        <h4 class="fw-bold mb-4" style="color:#000; font-size:1.3rem;">
            Contenido del libro
        </h4>

        @foreach($libro->capitulos as $index => $capitulo)
            <div class="mb-5">

                {{-- Título del capítulo --}}
                <h5 class="fw-bold mb-2" style="font-size:1.15rem; color:#000;">
                    {{ $capitulo->nombre }}
                </h5>

                {{-- Autores --}}
                @if($capitulo->autores->isNotEmpty())
                    <p class="mb-3">
                        <strong>Autor(es):</strong> 
                        {{ $capitulo->autores->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}
                    </p>
                @endif

                {{-- Descripción --}}
                @php $lineas = explode("\n", $capitulo->descripcion); @endphp
                @foreach($lineas as $linea)
                    @if(trim($linea) !== '')
                        <p style="text-indent: 2em; text-align: justify; line-height: 1.8; font-size:1rem; color:#333;">
                            {{ $linea }}
                        </p>
                    @endif
                @endforeach

                {{-- Cita del capítulo --}}
                @if($capitulo->cita_articulo)
                    @php $collapseId = 'citaCapitulo' . $index; @endphp
                    <div class="my-3">
                        <button class="btn btn-outline-dark btn-sm btn-cita" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#{{ $collapseId }}" 
                                aria-expanded="false" 
                                aria-controls="{{ $collapseId }}">
                            Ver cita
                        </button>

                        <div class="collapse mt-3" id="{{ $collapseId }}">
                            <div style="border-left:3px solid #000; padding-left:15px; font-style:italic;">
                                {{ $capitulo->cita_articulo }}
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.btn-cita').forEach(btn => {
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
