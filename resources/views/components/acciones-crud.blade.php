{{-- <div> --}}
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    @props(['model', 'routeName'])

<td>
    <div class="d-flex gap-1">
        {{-- Ver --}}
        <a href="{{ route("admin.{$routeName}.show", $model) }}" class="btn btn-info btn-sm" style="background-color:#7689A5; border:none;">Ver</a>

        {{-- Editar: solo admin o superadmin --}}
        @if(auth()->user()->hasRole(['SuperAdmin', 'Desarrollador','admin']))
            <a href="{{ route("admin.{$routeName}.edit", $model) }}" class="btn btn-warning btn-sm" style="background-color:#F2B81B; border:none;">Editar</a>
        @endif
    

        {{-- Editar permisos: solo SuperAdmin o Desarrollador, y solo en la ruta de roles --}}
        @if(auth()->user()->hasAnyRole('Desarrollador') && Route::is('admin.roles.index'))
            <a href="{{ route("admin.roles.editPermissions", $model) }}" class="btn btn-primary">Permisos</a>
        @endif




        {{-- Eliminar: solo superadmin --}}
        @if(auth()->user()->hasRole(['SuperAdmin', 'Desarrollador']))
            <form action="{{ route("admin.{$routeName}.destroy", $model) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
            </form>
        @endif
    </div>
</td> 

<!-- Cuadro 2 -->
  {{-- <div class="col-6 d-flex flex-column justify-content-center align-items-center p-4 quadrant" style="background-color:#FFFFFF;">
    <p class="fs-4 mb-0" style="color:#7689A5;">Más de</p>
    <h1 class="fw-bold counter" data-target="40" style="font-size:5rem; color:#7689A5;">0</h1>
    <p class="fs-4 mb-0" style="color:#7689A5;">Volúmenes</p>
  </div> --}}