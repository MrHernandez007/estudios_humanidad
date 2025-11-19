@extends('layouts.layout_general')

@section('contenido')

<!-- {{-- HERO con logo a lo largo de la pantalla --}} -->
<section class="w-100" style="background-color: transparent; padding: 0; margin: 0;">
    <div class="container-fluid p-0 m-0">
        <img src="{{ asset('imagenes/logos/1_LOGO_PRINCIPAL_con_titulo_ROJO.jpg') }}" 
             alt="Logo Estudios de la Humanidad" 
             class="img-fluid w-100" 
             style="height: 50px; object-fit: contain; display: block;">
    </div>
</section>

{{-- <hr class="my-5"> --}}

<hr style="width: 150px; border: 2px solid #F2B81B; margin: 2rem auto; opacity: 1; border-radius: 2px;">


<div class="container my-5">
    <h2 class="text-2xl mb-3">
        Resultados de: "{{ $q }}"
    </h2>

    <div class="card mb-4 shadow-sm border-0" style="background-color:#F4F5F7;">
        <div class="card-body">

            @if($resultados->isEmpty())
                <p>No se encontraron resultados.</p>
            @else

                <ul class="list-unstyled">
                    @foreach($resultados as $libro)
                        <li class="py-3">

                            {{-- Título --}}
                            <h3 class="font-bold text-lg">{{ $libro->titulo }}</h3>

                            {{-- Volumen --}}
                            @if($libro->volumen)
                                <p><strong>Volumen:</strong> {{ $libro->volumen }}</p>
                            @endif

                            {{-- Año --}}
                            @if($libro->anio)
                                <p><strong>Año:</strong> {{ $libro->anio }}</p>
                            @endif


                            @if($libro->nombre)
                                <p><strong>Autor(es):</strong> {{ $libro->nombre }} {{ $libro->apellido }}</p>
                            @endif


                            {{-- DOI --}}
                            {{-- @if($libro->doi)
                                <p><strong>DOI:</strong> {{ $libro->doi }}</p>
                            @endif --}}

                            {{-- Botón de detalle --}}
                            <a href="{{ route('general.libro.detalle', $libro->id) }}" 
                               class="btn btn-sm" 
                               style="background-color:#34142F; color:white;">
                                Ver detalle
                            </a>

                            {{-- Línea separadora --}}
                            @if(!$loop->last)
                                <hr class="mt-4" style="border-top: 1px solid #ccc;">
                            @endif

                        </li>
                    @endforeach
                </ul>

            @endif

        </div>
    </div>
</div>



@endsection
