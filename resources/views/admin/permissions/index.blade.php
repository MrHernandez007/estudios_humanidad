@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Permisos (Seguramente esto no se verá en el navbar final)</h2>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-success mb-2">➕ Nuevo Permiso (para posible futuro crecimiento de la página, ahora se crean automaticamente en el backend en "RoleController")</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Guard</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                {{-- <td>
                    <a href="{{ route('admin.permissions.show',$permission) }}" class="btn btn-info">👁 Ver</a>
                    <a href="{{ route('admin.permissions.edit',$permission) }}" class="btn btn-warning">✏️ Editar</a>
                    <form action="{{ route('admin.permissions.destroy',$permission) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Seguro?')">🗑 Eliminar</button>
                    </form>
                </td> --}}
                <x-acciones-crud :model="$permission" :routeName="'permissions'"/>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
