<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capitulo extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'capitulos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'libro_id',
        'nombre',
        'descripcion',
        'autor_id',
        'cita_articulo',
        'estado',
    ];

    // Campos tratados como fechas
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relación con Libro
     */
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    /**
     * Relación con Autor
     */
    /* este era antes
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    } 
    */
    
    /**
     * Relación muchos a muchos con Autor
     */
    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'capitulo_autor')
                    ->withTimestamps();
    }

}
