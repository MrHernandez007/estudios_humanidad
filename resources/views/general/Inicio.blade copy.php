@extends('layouts.layout_general')

@section('contenido')


{{-- Hero de bienvenida --}}
{{-- <section class="text-center py-5"> --}}

<section class="text-center py-5 bg-light">
    <div class="container">
        <h1 class="display-5 fw-bold">BIENVENIDX A ESTUDIOS DE LA HUMANIDAD</h1>
        <p class="lead text-muted">
            Textos académicos variados, individuales y colectivos completamente disponibles y gratuitos 
            para descarga en formato PDF
        </p>
    </div>
</section>

{{-- Carrusel tipo rectángulo horizontal, ancho completo --}}
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">

    @foreach($publicaciones as $key => $pub)
    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
      
      {{-- Fondo de carrusel --}}
      <div class="w-100" style="background-color: #c1275b; min-height: 60vh; display: flex; justify-content: center; align-items: center;">
        
        {{-- Contenido central tipo rectángulo --}}
        <div class="row w-100 justify-content-center align-items-center" style="max-width: 1200px; padding: 40px; border-radius: 15px;">
          
          {{-- Columna de texto --}}
          <div class="col-md-6 d-flex flex-column justify-content-center text-white">
            <h5 class="fst-italic">{{ ucfirst($pub->tipo) }}</h5>
            <h2 class="fw-bold">{{ $pub->titulo }}</h2>
            {{-- <p class="lead">{{ $pub->descripcion }}</p> --}}
            <small>{{ \Carbon\Carbon::parse($pub->fecha)->format('d M, Y') }}</small>

            {{-- @if($pub->tipo == 'convocatoria') --}}
              <a href="{{ route('general.publicacion.detalle', $pub->id) }}" class="btn btn-light btn-lg mt-3">Consulta las bases</a>
            {{-- @endif --}}
          </div>

          {{-- Columna de imagen --}}
@if($pub->imagen)
    <div class="col-md-6 d-flex align-items-center justify-content-center mt-3 mt-md-0">
        <img src="{{ asset('storage/' . $pub->imagen) }}" class="img-fluid rounded shadow" alt="Imagen de {{ $pub->titulo }}">
    </div>
@endif


        </div>

      </div>

    </div>
    @endforeach
  </div> 

  {{-- Flechas discretas --}}
  {{-- style="background-color: rgba(0,0,0,0.3); border-radius: 50%;" --}}
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" ></span> 
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" ></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>




    {{-- Controles --}}
    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div> --}}

<hr class="my-5">

{{-- Presentación --}}
<section class="container">
    <h2 class="fw-bold mb-3">Presentación</h2>
    <p class="text-muted">
        ESTUDIOS DE LA HUMANIDAD es, desde 2023, el nombre de la colección del Departamento de Estudios Mesoamericanos y Mexicanos, previamente Estudios del Hombre. Los motivos de esta actualización se detallan
aquí
Las temáticas abordadas en las publicaciones de la Colección Estudios de la Humanidad buscan aportar conocimientos sobre el ser humano y su incidencia en el mundo desde una perspectiva humanística y de las ciencias sociales, sin limitación de marco temporal y espacial. Se trata de textos que examinan, desde enfoques teóricos y metodológicos diversos y transdisciplinarios, los fenómenos de las diversas expresiones de la cultura material y simbólica de la Humanidad; se abordan también aspectos de la sociedad, de la historia, la etnohistoria y la etnografía del Occidente de México, de sus agentes individuales y colectivos, y sus movimientos sociales.
    </p>
</section>

{{-- Antecedentes --}}
<section class="container mt-5">
    <h2 class="fw-bold mb-3">Antecedentes</h2>
    <p class="text-muted">
        ESTUDIOS DEL HOMBRE fue creada en 1994 como una revista especializada en Antropología, Arqueología, Historia y Etnografía. La revista comenzó a ser una publicación temática a partir del número 5 con el tema “Ensayos sobre el tiempo”, en el año de 1997. A partir de 2004, la publicación se gestionó como una colección de libros y a partir de 2006, se crearon las series Antropología, Antropología de la alimentación, Arqueología, Historia, Interfaces y Ensayos.
    </p>
</section>

<hr class="my-5">

{{-- Comité editorial simplificado --}}
<section class="container my-4">
    <h3 class="fw-bold mb-3">Directora: Chloé Marie Pomedio</h3>
    <ul class="list-unstyled">
        @foreach($comite as $miembro)
            <li class="mb-2">
                <strong>{{ $miembro->nombre }} {{ $miembro->apellido }}</strong> — 
                <span class="text-muted">{{ $miembro->dependencia }}, {{ $miembro->pais }}</span>
            </li>
        @endforeach
    </ul>
</section>


<hr class="my-5">

{{-- Lineamientos --}}
<section class="container">
    <h3 class="fw-bold mb-3">Lineamientos y Normas</h3>

    <div class="row g-4">
        {{-- <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Lineamientos y normas del CUCSH</h5>
                    <p class="card-text">Consulta los lineamientos oficiales del CUCSH.</p>
                    <a href="{{ asset('pdfs/Lineamientos_CUCSH.pdf') }}" download class="btn btn-primary">
                        📥 Descargar PDF
                    </a>
                </div>
            </div>
        </div> --}}
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Dictaminación y normas editoriales</h5>
                    <p class="card-text">Revisa el proceso de dictaminación y las normas editoriales.</p>
                    <a href="{{ asset('pdfs/Proceso_dictaminacion.pdf') }}" download class="btn btn-primary">
                        📥 Descargar PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="my-5">

{{-- Propuestas --}}
<section class="container">
    <h3 class="fw-bold mb-3">Propuestas de números</h3>
    <p class="text-muted">
        De contar con un producto de investigación individual o colaborativo que presente afinidad con los principios de la colección Estudios de la Humanidad que interese ser publicado, podrá enviarse la propuesta para ser evaluada por el comité editorial a través del siguiente formulario. Una vez llenado deberá enviarse a la dirección de correo de la colección: edh.cucsh@academicos.udg.mx
    </p>
    <a href="{{ asset('pdfs/EDH_Formato_Presentacion_Propuesta_2025.docx') }}" download class="btn btn-success">
        📥 Descargar Formato (Word)
    </a>
</section>



@endsection
