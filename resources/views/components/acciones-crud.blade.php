{{-- <div> --}}
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
@props(['model', 'routeName'])

<td>
    <div class="d-flex gap-1">

        {{-- VER --}}
        @can("ver {$routeName}")
            <a href="{{ route("admin.{$routeName}.show", $model) }}"
               class="btn btn-info btn-sm"
               style="background-color:#7689A5; border:none;">
                Ver
            </a>
        @endcan

        {{-- EDITAR --}}
        @can("editar {$routeName}")
            <a href="{{ route("admin.{$routeName}.edit", $model) }}"
               class="btn btn-warning btn-sm"
               style="background-color:#F2B81B; border:none;">
                Editar
            </a>
        @endcan

        {{-- EDITAR PERMISOS (solo en admin.roles.index) --}}
        @can("gestionar permisos")
            @if(Route::is('admin.roles.index'))
                <a href="{{ route("admin.roles.editPermissions", $model) }}"
                   class="btn btn-primary btn-sm">
                    Permisos
                </a>
            @endif
        @endcan

        {{-- ELIMINAR --}}
        @can("eliminar {$routeName}")
            <form action="{{ route("admin.{$routeName}.destroy", $model) }}"
                  method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Seguro que deseas eliminar?')">
                    Eliminar
                </button>
            </form>
        @endcan

    </div>
</td>
