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

                        <x-acciones-crud :model="$autor" :routeName="'autores'"/>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay autores registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- {{ $autores->links() }} --}}
    {{ $autores->links('pagination::bootstrap-5') }}

</div>
@endsection
