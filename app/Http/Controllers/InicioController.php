<?php

namespace App\Http\Controllers;

use App\Models\ComiteEditorial;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Tipo;
use App\Models\Relacion;


class InicioController extends Controller
{
    public function index()
    {
        // Comité editorial activo
        $comite = ComiteEditorial::where('estado', 1)->get();

        $publicaciones = Publicacion::where('estado', 1)
            ->latest('fecha')
            ->get(); 

        // Traer los tipos para el navbar, las colecciones.
        $tipos = Tipo::orderBy('id')->get();

        return view('general.inicio', compact('comite', 'publicaciones', 'tipos'));
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

        if (!$q) {
            return view('general.resultados', [
                'resultados' => collect(),
                'q' => ''
            ]);
        }

        // Resultados desde Scout (Database Engine)
        $resultados = Relacion::search($q)->get();

        // Reordenar manualmente según coincidencia en el título
        $resultados = $resultados->sortBy(function ($item) use ($q) {

            $titulo = strtolower($item->titulo);
            $query  = strtolower($q);

            // PRIORIDAD:
            if ($titulo === $query) {
                return 1; // Coincidencia exacta → máxima prioridad
            }
            if (str_starts_with($titulo, $query)) {
                return 2; // Empieza igual
            }
            if (str_contains($titulo, $query)) {
                return 3; // Contiene la palabra
            }

            return 4; // Otros resultados
        });

        return view('general.resultados', [
            'resultados' => $resultados,
            'q' => $q
        ]);
    }


}
