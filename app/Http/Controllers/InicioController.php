<?php

namespace App\Http\Controllers;

use App\Models\ComiteEditorial;
use App\Models\Publicacion;

class InicioController extends Controller
{
    public function index()
    {
        // Comité editorial activo
        $comite = ComiteEditorial::where('estado', 1)->get();

        // Últimas 3 publicaciones activas para el carrusel (todas o solo convocatorias)
        $publicaciones = Publicacion::where('estado', 1)
            ->latest('fecha')
            // ->take(3)
            ->get();

        return view('general.inicio', compact('comite', 'publicaciones'));
    }

    public function publicacionDetalle($id)
    {
        // Obtener la publicación y asegurarse que sea una convocatoria activa
        $publicacion = Publicacion::where('estado', 1)
            // ->where('tipo', 'convocatoria')
            // ->with(['autores', 'serie', 'capitulos.autores'])
            ->findOrFail($id);

        return view('general.publicacion_detalle', compact('publicacion'));
    }
}
