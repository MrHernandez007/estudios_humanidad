<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'administradores';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'imagen',
        'usuario',
        'contrasena',
        'estado',
        'rol_id',
    ];

    // Campos tratados como fechas
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Si quieres encriptar la contraseña automáticamente
    public function setContrasenaAttribute($value)
    {
        $this->attributes['contrasena'] = bcrypt($value);
    }

    /**
     * Relación con rol
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
