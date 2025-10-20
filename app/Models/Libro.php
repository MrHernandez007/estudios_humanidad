<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'libros';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'titulo',
        'slug',
        'volumen',
        'anio',
        'resumen',
        'cita',
        'isbn',
        'isbn_coleccion',
        'palabras_clave',
        'resena',
        'documento',
        'pdf',
        'imagen',
        'estado',
        'series_id',
        'tipos_id',
        
    ];

    // Campos tratados como fechas
    protected $dates = [
        'anio',        // si quieres manejar el año como fecha
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relación con autores (muchos a muchos)
     */
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'libro_autor')
                    ->withPivot('rol')
                    ->withTimestamps();
    }

    

    /**
     * Relación con series (muchos a uno)
     */
    public function serie()
    {
        return $this->belongsTo(Serie::class, 'series_id');
    }

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class, 'libro_id');
    }

    public function tipo()
{
    return $this->belongsTo(Tipo::class, 'tipos_id'); 
    // 'tipos_id' es la columna en libros que referencia a tipos.id
}

// Libro.php
// public function getImagenUrlAttribute()
// {
//     return $this->imagen ? Storage::url($this->imagen) : null;
// }



    
}
