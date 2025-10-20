@extends('layouts.layout_admin')

@section('contenido')

    <h1>Listado de Administradores</h1><br>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">➕ Nuevo Administrador</a>

    <div class="container my-4">
    {{-- <h2 class="mb-4 text-center">Listado de Administradores</h2> --}}

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    {{-- <th>ID</th>
                    <th>Imagen</th> --}}
                    <th>Nombre</th>
                    {{-- <th>Apellido</th> --}}
                    <th>Correo</th>
                    {{-- <th>Teléfono</th>
                    <th>Usuario</th> --}}
                    <th>Estado</th>
                    {{-- <th>Rol</th> --}}
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($users as $user)
                    <tr>
                        {{-- <td>{{ $admin->id }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$admin->imagen) }}" 
                                 alt="Imagen" 
                                 class="rounded-circle"
                                 width="50" height="50">
                        </td> --}}
                        <td>{{ $user->name }}</td>
                        {{-- <td>{{ $admin->apellido }}</td> --}}
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ $admin->telefono }}</td>
                        <td>{{ $admin->usuario }}</td> --}}
                        <td>
                            <span class="badge {{ $user->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                        </td>
                        {{-- <td>
                            @if($admin->rol_id == 1)
                                <span class="badge bg-primary">Superadmin</span>
                            @else
                                <span class="badge bg-secondary">Admin</span>
                            @endif
                        </td> --}}
                        {{-- <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">Ver</a>
                            {{-- {{ route('administradores.show', $admin->id) }} --}
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-warning btn-sm">Editar</a>
                            {{-- {{ route('administradores.edit', $admin->id) }} --}
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                {{-- {{ route('administradores.destroy', $admin->id) }} --}
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este registro?')">Eliminar</button>
                            </form>
                        </td> --}}

                        <x-acciones-crud :model="$user" :routeName="'users'"/>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">No hay administradores registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>




@endsection


