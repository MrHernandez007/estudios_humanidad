<?php

namespace App\Http\Controllers;

use App\Models\ComiteEditorial;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Libro;


class InicioController extends Controller
{
    public function index()
    {
        // Comité editorial activo
        $comite = ComiteEditorial::where('estado', 1)->get();

        $publicaciones = Publicacion::where('estado', 1)
            ->latest('fecha')
            ->get();

        return view('general.inicio', compact('comite', 'publicaciones'));
    }

    public function publicacionDetalle($id)
    {
        // Obtener la publicación y asegurarse que sea una convocatoria activa
        $publicacion = Publicacion::where('estado', 1)
            ->findOrFail($id);

        return view('general.publicacion_detalle', compact('publicacion'));
    }

    public function buscar(Request $request)
    {
        $q = $request->input('q');

        // Si no hay búsqueda, devolvemos vacío
        if (!$q) {
            return view('general.resultados', [
                'resultados' => collect(),
                'q' => ''
            ]);
        }

        // Búsqueda con Scout/Meilisearch
        $resultados = Libro::search($q)->get();

        return view('general.resultados', compact('resultados', 'q'));
    }
}
