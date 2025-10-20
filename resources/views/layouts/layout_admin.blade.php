<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Estudios Humanidad')</title>
    {{-- @vite(['resources/js/app.js']) --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>

    <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
    <div class="container-fluid">
        <!-- LOGO O NOMBRE -->
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            {{ Auth::user()->name ?? 'Logo??? Dash' }}
        </a>

        <!-- Botón para móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links de navegación -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Lista principal -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Administradores -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inicio.general') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.users.index') }}">
                        Administradores
                    </a>
                </li>

                

                <!-- roles -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inicio.general') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.roles.index') }}">
                        Roles
                    </a>
                </li>

                <!-- poermisos -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inicio.general') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.permissions.index') }}">
                        Permisos
                    </a>
                </li>

                <!-- Comite editorial -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inicio.general') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.comite_editorial.index') }}">
                        Comite editorial
                    </a>
                </li>

                <!-- Otro -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.publicaciones.index') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.publicaciones.index') }}">
                    Publicaciones
                    </a>
                </li>

                <!-- Dropdown Anuncios 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Anuncios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Noticias</a></li>
                        <li><a class="dropdown-item" href="#">Convocatorias</a></li>
                        <li><a class="dropdown-item" href="#">Eventos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Otro?</a></li>
                    </ul>
                </li> -->

                <!-- Dropdown Publicaciones -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Libros
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.autores.index') }}">Autores</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.series.index') }}">Series</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.capitulos.index') }}">Capitulos</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.tipos.index') }}">Colecciones</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.libros.index') }}">Libros</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav me-auto">
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>

    </div>
</nav>


    <!-- CONTENIDO PRINCIPAL -->
    <div class="container my-5">
        @yield('contenido') @section('contenido') 
    </div>

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
            </div>
        </div>

        <div class="text-center py-3 border-top small">
            &copy; 2025 Estudios Humanidad
        </div>
    </div>
</footer>


</body>
</html>
