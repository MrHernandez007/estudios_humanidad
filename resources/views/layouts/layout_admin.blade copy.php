<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Estudios Humanidad')</title>
    {{-- @vite(['resources/js/app.js']) --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet"> <!-- Para la tipografía -->
        <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('imagenes/logos/2A_Logo_blanco_circulo_MORADO.png') }}">


</head>
<body style="background-color: #FFFFFF; min-height: 100vh; margin: 0; padding: 0;">


<!-- NAVBAR ADMIN -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #EDE4CA; font-family: 'Cambria', sans-serif;">
    <div class="container">

        <!-- Logo y nombre del usuario -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('imagenes/logos/2A_Logo_blanco_circulo_MORADO.png') }}" 
                alt="Logo" 
                width="35" 
                height="35" 
                class="d-inline-block me-2">
            <span style="color: #4a4a4a;">{{ Auth::user()->name ?? '-' }}</span>
        </a>

        <!-- Botón hamburguesa (móvil) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" 
            aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable -->
        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                {{-- 🔒 Administradores → sólo SuperAdmin --}}
                @if(auth()->user()->hasRole(['SuperAdmin', 'Desarrollador']))
                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active fw-bold' : '' }}" 
                        href="{{ route('admin.users.index') }}"
                        style="color: #4a4a4a !important;">
                            Administradores
                        </a>
                    </li>
                @endif

                {{-- 🔒 Roles y Permisos → sólo Desarrollador --}}
                @if(auth()->user()->hasRole('Desarrollador'))
                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->routeIs('admin.roles.index') ? 'active fw-bold' : '' }}" 
                        href="{{ route('admin.roles.index') }}"
                        style="color: #4a4a4a !important;">
                            Roles
                        </a>
                    </li>

                    <li class="nav-item px-2">
                        <a class="nav-link {{ request()->routeIs('admin.permissions.index') ? 'active fw-bold' : '' }}" 
                        href="{{ route('admin.permissions.index') }}"
                        style="color: #4a4a4a !important;">
                            Permisos
                        </a>
                    </li>
                @endif

                <!-- Comité editorial -->
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('admin.comite_editorial.index') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.comite_editorial.index') }}"
                       style="color: #4a4a4a !important;">
                        Comité editorial
                    </a>
                </li>

                <!-- Publicaciones -->
                <li class="nav-item px-2">
                    <a class="nav-link {{ request()->routeIs('admin.publicaciones.index') ? 'active fw-bold' : '' }}" 
                       href="{{ route('admin.publicaciones.index') }}"
                       style="color: #4a4a4a !important;">
                        Publicaciones
                    </a>
                </li>

                <!-- Dropdown Libros -->
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                       style="color: #4a4a4a;">
                        Libros
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.autores.index') }}">Autores</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.series.index') }}">Series</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.capitulos.index') }}">Capítulos</a></li>

                        {{-- 🔒 Colecciones → sólo Desarrollador --}}
                        @if(auth()->user()->hasRole('Desarrollador'))
                            <li><a class="dropdown-item" href="{{ route('admin.tipos.index') }}">Colecciones</a></li>
                        @endif

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.libros.index') }}">Libros</a></li>
                    </ul>
                </li>

            </ul>

            <!-- Right side: logout -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                           style="color: #4a4a4a;">
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



<!-- {{-- HERO con logo a lo largo de la pantalla --}} -->
<section class="w-100" style="background-color: transparent; padding: 0; margin: 0;">
    <div class="container-fluid p-0 m-0">
        <img src="{{ asset('imagenes/logos/2_Logo_con_titulo_MORADO.jpg') }}" 
             alt="Logo Estudios de la Humanidad" 
             class="img-fluid w-100" 
             style="height: 50px; object-fit: contain; display: block;">
    </div>
</section>


    {{-- <!-- CONTENIDO PRINCIPAL  --> @section('contenido')  --}}
    <div style="background-color: #FFFFFF; font-family: 'Cambria', sans-serif; padding-bottom: 50px;">  <!-- Color del Fondo y tipografía -->
        @yield('contenido') 
    </div>


</body>
</html>
