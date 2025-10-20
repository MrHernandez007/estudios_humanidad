@extends('layouts.layout_admin')

@section('contenido')
<div class="container mt-4">
    <h2>Nuevo Libro</h2>

    <form action="{{ route('admin.libros.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
            <input type="text" name="titulo" id="titulo" class="form-control" required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo <span class="text-danger">*</span></label>
            <select name="tipos_id" id="tipo" class="form-select" required>
                <option value="">-- Seleccione tipo --</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="volumen" class="form-label">Volumen</label>
            <input type="text" name="volumen" id="volumen" class="form-control" maxlength="50">
        </div>

        <div class="mb-3">
            <label for="anio" class="form-label">Año</label>
            <input type="number" name="anio" id="anio" class="form-control" min="1901" max="2155" placeholder="1901 - 2155">
        </div>

        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen</label>
            <textarea name="resumen" id="resumen" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="cita" class="form-label">Cita</label>
            <textarea name="cita" id="cita" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" maxlength="20">
        </div>

        <div class="mb-3">
            <label for="isbn_coleccion" class="form-label">ISBN de la colección</label>
            <input type="text" name="isbn_coleccion" id="isbn_coleccion" class="form-control" maxlength="20">
        </div>

        <div class="mb-3">
            <label for="palabras_clave" class="form-label">Palabras clave</label>
            <textarea name="palabras_clave" id="palabras_clave" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="resena" class="form-label">Reseña</label>
            <textarea name="resena" id="resena" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento (texto o URL)</label>
            <textarea name="documento" id="documento" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="series_id" class="form-label">Serie</label>
            <select name="series_id" id="series_id" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($series as $serie)
                    <option value="{{ $serie->id }}">{{ $serie->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- 🔹 Bloque de autores --}}
        <div id="autores-wrapper">
            <div class="autor-rol mb-2 d-flex align-items-center">
                <select name="roles[0][autor_id]" class="form-select me-2">
                    <option value="">-- Seleccione autor --</option>
                    @foreach($autores as $autor)
                        <option value="{{ $autor->id }}">{{ $autor->nombre }} {{ $autor->apellido }}</option>
                    @endforeach
                </select>

                <select name="roles[0][roles][]" class="form-select me-2" multiple>
                    <option value="autor_libro">Autor</option>
                    <option value="coordinador">Coordinador</option>
                    <option value="presentador">Presentador</option>
                    <option value="Preface/Foreword">Preface/Foreword</option>
                </select>

                <button type="button" class="btn btn-danger remove-autor">❌</button>
            </div>
        </div>

        <button type="button" id="add-autor" class="btn btn-primary mb-3">➕ Añadir autor</button>

        <script>
        let index = 1;
        document.getElementById('add-autor').addEventListener('click', function() {
            let wrapper = document.getElementById('autores-wrapper');
            let clone = wrapper.children[0].cloneNode(true);
            clone.querySelectorAll('select').forEach((select) => {
                let name = select.getAttribute('name');
                select.setAttribute('name', name.replace(/\d+/, index));
                select.value = '';
            });
            wrapper.appendChild(clone);
            index++;
        });

        document.addEventListener('click', function(e){
            if(e.target.classList.contains('remove-autor')){
                e.target.closest('.autor-rol').remove();
            }
        });
        </script>

        {{-- 🔹 Fin bloque autores --}}

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/png,image/jpeg,image/jpg">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">💾 Guardar</button>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">⬅️ Volver</a>
    </form>
</div>
@endsection
