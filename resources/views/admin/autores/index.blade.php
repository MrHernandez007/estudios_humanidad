@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Autores</h2>

    <a href="{{ route('admin.autores.create') }}" class="btn btn-primary mb-3">➕ Nuevo Autor</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nombre }}</td>
                    <td>{{ $autor->apellido }}</td>
                    <td>
                        <span class="badge {{ $autor->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $autor->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    {{-- <td>
                        {{-- @include('botones',$areP) --}
                        <a href="{{ route('admin.autores.show', $autor) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                        <a href="{{ route('admin.autores.edit', $autor) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <form action="{{ route('admin.autores.destroy', $autor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este autor?')">🗑️ Eliminar</button>
                        </form>
                    </td> --}}
                    {{-- Botones de acciones según permisos --}}
                        {{-- <x-acciones-crud :model="$autor" route-name="autores"/> --}}
                        <x-acciones-crud :model="$autor" :routeName="'autores'"/>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay autores registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $autores->links() }}
</div>
@endsection
