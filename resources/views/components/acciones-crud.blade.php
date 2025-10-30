{{-- <div> --}}
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    @props(['model', 'routeName'])

<td>
    <div class="d-flex gap-1">
        {{-- Ver --}}
        <a href="{{ route("admin.{$routeName}.show", $model) }}" class="btn btn-info btn-sm">Ver</a>

        {{-- Editar: solo admin o superadmin --}}
        @if(auth()->user()->hasRole(['admin', 'SuperAdmin']))
            <a href="{{ route("admin.{$routeName}.edit", $model) }}" class="btn btn-warning btn-sm">Editar</a>
        @endif
        
        {{-- Editar permisos: solo SuperAdmin y en la ruta de roles --}}
        @if(auth()->user()->hasRole('SuperAdmin') && Route::is('admin.roles.index'))
            <a href="{{ route("admin.roles.editPermissions", $model) }}" class="btn btn-primary">Permisos</a>
        @endif



        {{-- Eliminar: solo superadmin --}}
        @if(auth()->user()->hasRole('SuperAdmin'))
            <form action="{{ route("admin.{$routeName}.destroy", $model) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
            </form>
        @endif
    </div>
</td>

{{--opbion b --}}

{{-- resources/views/includes/acciones-crud.blade.php --}}
{{-- <td>
    @can("{$routeName} Ver")
        <a href="{{ route("admin.{$routeName}.show", $model) }}" class="btn btn-info btn-sm">👁️ Ver</a>
    @endcan
    @can("{$routeName} Editar")
        <a href="{{ route("admin.{$routeName}.edit", $model) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
    @endcan
    @can("{$routeName} Eliminar")
        <form action="{{ route("admin.{$routeName}.destroy", $model) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar?')">🗑️ Eliminar</button>
        </form>
    @endcan
</td> --}}

{{-- y en los indices:

@include('includes.acciones-crud', ['model' => $autor, 'routeName' => 'autores']) --}}


{{-- </div> --}}