<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW relaciones AS
            select
                libros.id AS id,
                libros.titulo AS titulo,
                libros.slug AS slug,
                libros.volumen AS volumen,
                libros.anio AS anio,
                libros.resumen AS resumen,
                libros.cita AS cita,
                libros.isbn AS isbn,
                libros.isbn_coleccion AS isbn_coleccion,
                libros.palabras_clave AS palabras_clave,
                libros.resena AS resena,
                libros.doi AS doi,
                libros.pdf AS pdf,
                libros.imagen AS imagen,
                libros.estado AS estado,
                libros.series_id AS series_id,
                libros.tipos_id AS tipos_id,
                libros.deleted_at AS deleted_at,
                libros.created_at AS created_at,
                libros.updated_at AS updated_at,
                GROUP_CONCAT(DISTINCT CONCAT(autores.nombre, ' ', autores.apellido) 
                    SEPARATOR ', ') AS nombre
            from libros
            left join libro_autor on libros.id = libro_autor.libro_id
            left join autores on libro_autor.autor_id = autores.id
            where libros.deleted_at is null
                and libros.estado = 1
                and (autores.deleted_at is null or autores.id is null)
                and (autores.estado = 1 or autores.id is null)
            group by libros.id, libros.titulo, libros.slug, libros.volumen,
                     libros.anio, libros.resumen, libros.cita, libros.isbn,
                     libros.isbn_coleccion, libros.palabras_clave, libros.resena,
                     libros.doi, libros.pdf, libros.imagen, libros.estado,
                     libros.series_id, libros.tipos_id, libros.deleted_at,
                     libros.created_at, libros.updated_at
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS relaciones");
    }
};
