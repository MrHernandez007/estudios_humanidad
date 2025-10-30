@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Tipos (Colecciones, no sé si aparecerá en el nabvar final)</h2>

    <a href="{{ route('admin.tipos.create') }}" class="btn btn-primary mb-3">➕ Nuevo Tipo (para posible futuro crecimiento de la página)</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tipos as $tipo)
                <tr>
                    <td>{{ $tipo->id }}</td>
                    <td>{{ $tipo->nombre }}</td>
                    <td>
                        <span class="badge {{ $tipo->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $tipo->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    {{-- <td>
                        <a href="{{ route('admin.tipos.show', $tipo) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                        <a href="{{ route('admin.tipos.edit', $tipo) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <form action="{{ route('admin.tipos.destroy', $tipo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este tipo?')">🗑️ Eliminar</button>
                        </form>
                    </td> --}}
                    <x-acciones-crud :model="$tipo" :routeName="'tipos'"/>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay tipos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $tipos->links('pagination::bootstrap-5') }}
</div>
@endsection
