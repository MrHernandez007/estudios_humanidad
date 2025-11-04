@extends('layouts.layout_general')

@section('contenido')

<h1>{{ $libro->titulo }}</h1>

{{-- <img src="{{ asset($libro->imagen) }}" alt="{{ $libro->titulo }}" class="img-fluid mb-3"> --}}
<img src="{{ Storage::url($libro->imagen) }}" alt="{{ $libro->titulo }}" class="img-fluid mb-3">


<h2>Autores</h2>

@php
    $roles = ['autor_libro' => 'Autor', 
              'coordinador' => 'Coordinador', 
              'presentador' => 'Presentador', 
              'Preface/Foreword' => 'Preface/Foreword'];
@endphp

@foreach($roles as $clave => $nombreRol)
    @php
        $autoresPorRol = $libro->autores->filter(fn($a) => in_array($clave, explode(',', $a->pivot->rol)));
    @endphp

    @if($autoresPorRol->isNotEmpty())
        <p><strong>{{ $nombreRol }}:</strong> 
            {{ $autoresPorRol->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}
        </p>
    @endif
@endforeach

{{-- <p><strong>Tipo:</strong> {{ $libro->tipo->nombre ?? '' }}</p> NO ES NECESARIO MOSTRARLO AQUI--}}
@if($libro->serie)
<p><strong>Serie:</strong> {{ $libro->serie->nombre ?? '' }}</p>
@endif
<p><strong>Volumen:</strong> {{ $libro->volumen }}</p>
<p><strong>Año:</strong> {{ $libro->anio }}</p>

{{-- <p><strong>Resumen:</strong> {{ $libro->resumen }}</p> para respetar los saltos de linea--}}
<p><strong>Resumen:</strong>  {!! nl2br(e($libro->resumen)) !!}</p>

{{-- <p><strong>Reseña:</strong> {{ $libro->resena }}</p>  NO SE USA--}}
{{-- <p><strong>Palabras clave:</strong> {{ $libro->palabras_clave }}</p> --}}
@if(!empty($libro->palabras_clave))
    <p><strong>Palabras clave:</strong> {{ $libro->palabras_clave }}</p>
@endif


<p><strong>ISBN:</strong> {{ $libro->isbn }}</p>

{{-- <p><strong>ISBN colección:</strong> {{ $libro->isbn_coleccion }}</p> --}}
@if(!empty($libro->isbn_coleccion))
    <p><strong>ISBN colección:</strong> {{ $libro->isbn_coleccion }}</p>
@endif

{{-- <p><strong>ISBN colección:</strong> {{ $libro->isbn_coleccion }}</p> --}}

@if($libro->pdf)
    <p><strong>Documento:</strong> <a href="{{ asset('storage/' . $libro->pdf) }}" target="_blank">📄 Ver PDF</a></p>
@endif

{{-- <a href="{{ asset($libro->pdf) }}" target="_blank">Descargar</a> esto es lo que estaba antes --}}

<h2>Capítulos</h2>
@foreach($libro->capitulos as $capitulo)
    <div class="mb-3">
        <h5>{{ $capitulo->nombre }}</h5>

        @if($capitulo->autores->isNotEmpty())
            <p>
                <strong>Autor(es) del capítulo:</strong>
                {{ $capitulo->autores->map(fn($a) => $a->nombre . ' ' . $a->apellido)->join(', ') }}
            </p>
        @endif

        {{-- @if($capitulo->descripcion->isNotEmpty()) --}}
            <p>
                {{-- <strong>Sub-capitulos? o nadota?:</strong><br> --}}
                {{-- Sub-capitulos? o nadota?: --}}
                {!! nl2br(e($capitulo->descripcion )) !!}
            </p>
        {{-- @endif --}}

        {{-- @if($capitulo->cita_articulo)
            <p> <strong>cita del capítulo:</strong>
                {{ $capitulo->cita_articulo }}
            </p> 
            {{-- <strong>Descripción:</strong> <br> --
        @endif --}}

@if($capitulo->cita_articulo)
<div class="my-3">
  <p class="fw-bold mb-1">📘 Cita del capítulo:</p>
  
  <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#citaCapitulo" aria-expanded="false" aria-controls="citaCapitulo">
    Ver cita
  </button>

  <div class="collapse mt-3" id="citaCapitulo">
    <div class="card card-body">
      {{ $capitulo->cita_articulo }}
    </div>
  </div>
</div>
@endif




    </div>
@endforeach


<a href="{{ route('general.coleccion', $libro->tipos_id) }}" class="btn btn-secondary">Regresar a la colección</a>

@endsection

