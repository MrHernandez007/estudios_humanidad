@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Series</h2>

    <a href="{{ route('admin.series.create') }}" class="btn btn-primary mb-3" style="background-color: #34142F; border: none; outline: none; box-shadow: none;">➕ Nueva Serie</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm rounded">
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
            @forelse($series as $serie)
                <tr>
                    <td>{{ $serie->id }}</td>
                    <td>{{ $serie->nombre }}</td>
                    <td>
                        <span class="badge {{ $serie->estado ? 'bg-success' : 'bg-danger' }}">
                            {{ $serie->estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    {{-- <td>
                        <a href="{{ route('admin.series.show', $serie) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                        <a href="{{ route('admin.series.edit', $serie) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <form action="{{ route('admin.series.destroy', $serie) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta serie?')">🗑️ Eliminar</button>
                        </form>
                    </td> --}}
                    <x-acciones-crud :model="$serie" :routeName="'series'"/>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay series registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    {{ $series->links('pagination::bootstrap-5') }}
</div>
@endsection
