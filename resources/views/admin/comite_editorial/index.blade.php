@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Comité Editorial</h2>

    <a href="{{ route('admin.comite_editorial.create') }}" class="btn btn-primary mb-3">➕ Nuevo Miembro</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dependencia</th>
                <th>País</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comite as $miembro)
                <tr>
                    <td>{{ $miembro->id }}</td>
                    <td>{{ $miembro->nombre }}</td>
                    <td>{{ $miembro->apellido }}</td>
                    <td>{{ $miembro->dependencia }}</td>
                    <td>{{ $miembro->pais }}</td>
                    <td>
                        <span class="badge {{ $miembro->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $miembro->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    {{-- <td>
                        <a href="{{ route('admin.comite_editorial.show', $miembro) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                        <a href="{{ route('admin.comite_editorial.edit', $miembro) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <form action="{{ route('admin.comite_editorial.destroy', $miembro) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este miembro?')">🗑️ Eliminar</button>
                        </form>
                    </td> --}}
                    <x-acciones-crud :model="$miembro" :routeName="'comite_editorial'"/>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay miembros registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $comite->links('pagination::bootstrap-5') }}
</div>
@endsection
