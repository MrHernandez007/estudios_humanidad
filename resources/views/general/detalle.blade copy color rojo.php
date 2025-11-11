@extends('layouts.layout_general')

@section('contenido')
<div style="font-family: 'Cambria', sans-serif;">



<div class="container my-5">

    {{-- Título del libro --}}
    <h1 class="mb-4 fw-bold text-center" style="color:#34142F;">{{ $libro->titulo }}</h1>

    {{-- Imagen del libro --}}
    <div class="text-center mb-4">
        <img src="{{ Storage::url($libro->imagen) }}" 
             alt="{{ $libro->titulo }}" 
             class="img-fluid rounded shadow-lg border border-3" 
             style="max-height: 450px; object-fit: cover; border-color:#F2B81B;">
    </div>


    {{-- Información general --}}
    <div class="card shadow-sm mb-5 border-0" style="background-color:#F9F9F9;">
        <div class="card-body p-4">
            <h4 class="card-title mb-4 fw-bold" style="color:#E44942;">Información del libro</h4>

            {{-- Autores --}}
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
                    <span style="color:#34142F;">{{ $autoresPorRol->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}</span></p>
                @endif
            @endforeach

            @if($libro->serie)
                <p><strong>Serie:</strong> <span style="color:#34142F;">{{ $libro->serie->nombre }}</span></p>
            @endif

            <p><strong>Volumen:</strong> <span style="color:#34142F;">{{ $libro->volumen }}</span></p>
            <p><strong>Año:</strong> <span style="color:#34142F;">{{ $libro->anio }}</span></p>

            <p><strong>Resumen:</strong> <span style="color:#7689A5; text-align: justify; display: block;">{!! nl2br(e($libro->resumen)) !!}</span></p>

            @if(!empty($libro->palabras_clave))
                <p><strong>Palabras clave:</strong> <span style="color:#34142F;">{{ $libro->palabras_clave }}</span></p>
            @endif

            <p><strong>ISBN:</strong> <span style="color:#34142F;">{{ $libro->isbn }}</span></p>

            @if(!empty($libro->isbn_coleccion))
                <p><strong>ISBN colección:</strong> <span style="color:#34142F;">{{ $libro->isbn_coleccion }}</span></p>
            @endif

            @if(!empty($libro->cita))
                <p><strong>¿Cómo citar?:</strong> <span style="color:#34142F;">{{ $libro->cita }}</span></p>
            @endif

            @if($libro->pdf)
                <p><strong>Documento:</strong> 
                    <a href="{{ asset('storage/' . $libro->pdf) }}" 
                       target="_blank" 
                       class="btn btn-sm text-white"
                       style="background-color:#F2B81B;">
                       Ver PDF
                    </a>
                </p>
            @endif
        </div>
    </div>

    {{-- Capítulos --}}
    {{-- <h3 class="mb-4 fw-bold text-center" style="color:#34142F;">Contenido del libro</h3> --}}

    <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title mb-4 fw-bold" style="color:#E44942;">Contenido del libro</h4>
    @foreach($libro->capitulos as $index => $capitulo)
        
                <h5 class="card-title fw-bold" style="color:#E44942;">{{ $capitulo->nombre }}</h5> <br>

                @if($capitulo->autores->isNotEmpty())
                    <p><strong>Autor(es):</strong> 
                    <span style="color:#34142F;">{{ $capitulo->autores->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}</span></p>
                @endif

                @php
                    $lineas = explode("\n", $capitulo->descripcion);
                @endphp

                @foreach($lineas as $linea)
                    @if(trim($linea) !== '')
                        <p class="text-muted" style="text-indent: 2em; text-align: justify; line-height: 1.7;">
                            {{ $linea }}
                        </p>
                    @endif
                @endforeach


                {{-- Cita del capítulo con collapse --}}
                @if($capitulo->cita_articulo)
                    @php $collapseId = 'citaCapitulo' . $index; @endphp

                    <div class="my-3">
                        <button class="btn btn-outline-primary btn-sm" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#{{ $collapseId }}" 
                                aria-expanded="false" 
                                aria-controls="{{ $collapseId }}"
                                style="border-color:#7689A5; color:#7689A5;">
                            Ver cita
                        </button>

                        <div class="collapse mt-3" id="{{ $collapseId }}">
                            <div class="card card-body" style="background-color:#FFF5E1; border-left:5px solid #F2B81B;">
                                <em>{{ $capitulo->cita_articulo }}</em>
                            </div>
                        </div>
                    </div>
                @endif
            
    @endforeach
    </div>
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
