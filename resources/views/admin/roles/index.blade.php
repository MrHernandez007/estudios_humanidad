@extends('layouts.layout_admin')
@section('contenido')
<div class="container mt-4">
    <h2>Roles (Seguramente esto no se verá en el navbar final)</h2>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">➕ Nuevo Rol (para posible futuro crecimiento de la página)</a>
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
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>
                
                    {{-- <a href="{{ route('admin.roles.show',$role) }}" class="btn btn-info">👁 Ver</a>
                    <a href="{{ route('admin.roles.edit',$role) }}" class="btn btn-warning">✏️ Editar</a>
                    <a href="{{ route('admin.roles.editPermissions', $role) }}" class="btn btn-primary">🔑 Permisos</a>
                    <form action="{{ route('admin.roles.destroy',$role) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Seguro?')">🗑 Eliminar</button>
                    </form> --}}
                    
                
                 <x-acciones-crud :model="$role" :routeName="'roles'"/>

            </tr>
            @endforeach
        </tbody>
    </table>
            {{-- {{ $role->links('pagination::bootstrap-5') }} --}}

</div>
@endsection
