<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Estudios Humanidad')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    <img src="{{ asset('imagenes/ColeccionEstudiosDeLaHumanidad.png') }}" alt="imagen_coleccion" class="img-fluid">


    <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" style="background-color: #fff; border-bottom: 1px solid #ddd;">
    <div class="container">

        <!-- Links de navegación centrados -->
        <div class="mx-auto"> <!-- Este div centrará el contenido -->
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item px-5 border-end">
                    <a class="nav-link {{ request()->routeIs('general.inicio') ? 'fw-bold text-dark' : 'text-muted' }}" 
                       href="{{ route('general.inicio') }}">
                        Inicio
                    </a>
                </li>
                <li class="nav-item px-5 border-end">
                    <a class="nav-link {{ request()->routeIs('general.coleccion') && request()->route('tipo') == 7 ? 'fw-bold text-dark' : 'text-muted' }}" 
                       href="{{ route('general.coleccion', 7) }}"> 
                        Estudios de la Humanidad
                    </a>
                </li>
                <li class="nav-item px-5 border-end">
                    <a class="nav-link {{ request()->routeIs('general.coleccion') && request()->route('tipo') == 8 ? 'fw-bold text-dark' : 'text-muted' }}" 
                       href="{{ route('general.coleccion', 8) }}">
                        Estudios del Hombre
                    </a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link {{ request()->routeIs('general.coleccion') && request()->route('tipo') == 9 ? 'fw-bold text-dark' : 'text-muted' }}" 
                       href="{{ route('general.coleccion', 9) }}">
                        Revista Estudios del Hombre
                    </a>
                </li>
            </ul>
        </div>

    

    </div>
</nav>



    <!-- CONTENIDO -->
    {{-- <div style="background-color: #FEF8F0;"> Fondo color crema --}}

    {{-- <div class="container my-5"> --}}
        @yield('contenido')
    {{-- </div> --}}

    <!-- FOOTER -->
    <footer class="bg-light text-dark pt-5">
    <div class="container">
        <div class="row text-center text-md-start justify-content-center">
            <!-- Dirección -->
            <div class="col-md-4 mb-4">
                <i class="bi bi-geo-alt-fill fs-4"></i>
                <h6 class="mt-2">Dirección</h6>
                <p class="small">
                    Estudios Mesoamericanos y Mexicanos Ave. Parres Arias Núm. 150<br>
                    Esquina con periférico norte<br>
                    Colonia San José del Bajío, C.P. 45132<br>
                    Zapopan, Jalisco, México<br>
                    Edificio A Planta Baja, Núcleo Los Belenes
                </p>
            </div>

            <!-- Teléfono -->
            <div class="col-md-4 mb-4">
                <i class="bi bi-telephone-fill fs-4"></i>
                <h6 class="mt-2">Teléfono</h6>
                <p class="small">(33) 3819-3365, Ext. 23365</p>
            </div>

            <!-- Correo -->
            <div class="col-md-4 mb-4">
                <i class="bi bi-envelope-fill fs-4"></i>
                <h6 class="mt-2">Correo</h6>
                <p class="small">edh.cucsh@academicos.udg.mx</p>


                <!-- Login a la derecha -->
        <ul class="navbar-nav ms-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link text-muted" href="{{ route('login') }}">Login</a>
                </li>
            @endguest
        </ul>
            </div>

         
        </div>

        <div class="text-center py-3 border-top small">
            &copy; 2025 Estudios Humanidad
        </div>
    </div>
</footer>


</body>
</html>
