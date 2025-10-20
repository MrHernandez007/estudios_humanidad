<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosPublicController extends Controller
{
    // public function index()
    // {
    //     // Obtener todos los libros o filtrarlos por colección
    //     $libros = Libro::all(); // o Libro::where('coleccion', 'Estudios del Hombre')->get();

    //     return view('publico.coleccion', compact('libros'));
    // }


//     public function index()
// {
//     // Trae todos los libros o puedes filtrar por colección
//     $libros = Libro::all(); 
//     return view('general.coleccion', compact('libros'));
// }

    public function index($tipo)
{
    // Buscar el tipo por id
    $tipoSeleccionado = \App\Models\Tipo::findOrFail($tipo);

    // Filtrar libros de ese tipo
    $libros = \App\Models\Libro::where('tipos_id', $tipoSeleccionado->id)->get();

    return view('general.coleccion', compact('libros', 'tipoSeleccionado'));
}



    // public function show($id)
    // {
    //     $libro = Libro::findOrFail($id); // Muestra detalle de un libro
    //     return view('general.detalle', compact('libro'));
    // }

    public function show($id)
{
    $libro = Libro::with(['autores', 'serie', 'tipo', 'capitulos.autores'])->findOrFail($id);
    

    return view('general.detalle', compact('libro'));
}

}
