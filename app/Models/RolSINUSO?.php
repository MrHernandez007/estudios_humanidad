<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'roles';

    // Llave primaria
    protected $primaryKey = 'id';

    // Campos asignables masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Relación uno a muchos con administradores
     * Un rol puede tener muchos administradores
     */
    public function administradores()
    {
        return $this->hasMany(Administrador::class, 'rol_id');
    }
}
