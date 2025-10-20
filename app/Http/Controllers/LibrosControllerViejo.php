<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LibrosController extends Controller
{
    /**
     * Mostrar todos los libros
     */
    public function index()
    {
        $libros = Libro::with('serie')->latest()->paginate(10);
        return view('admin.libros.index', compact('libros'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $series = Serie::where('estado', 1)->get(); // Solo series activas
        return view('admin.libros.create', compact('series'));
    }

    /**
     * Guardar un libro nuevo
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255|unique:libros,titulo',
            'volumen' => 'nullable|max:50',
            'anio' => 'nullable|digits:4|integer',
            'resumen' => 'nullable',
            'cita' => 'nullable',
            'isbn' => 'nullable|max:20',
            'isbn_coleccion' => 'nullable|max:20',
            'palabras_clave' => 'nullable',
            'resena' => 'nullable',
            'documento' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB
            'estado' => 'required|boolean',
            'series_id' => 'nullable|exists:series,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->titulo);

        // Guardar imagen si existe
        if($request->hasFile('imagen')){
            $data['imagen'] = $request->file('imagen')->store('libros', 'public');
        }

        Libro::create($data);

        return redirect()->route('admin.libros.index')->with('success', 'Libro creado correctamente.');
    }

    /**
     * Mostrar un libro
     */
    public function show(Libro $libro)
    {
        return view('admin.libros.show', compact('libro'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Libro $libro)
    {
        $series = Serie::where('estado', 1)->get(); // Solo series activas
        return view('admin.libros.edit', compact('libro', 'series'));
    }

    /**
     * Actualizar un libro
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo' => 'required|max:255|unique:libros,titulo,'.$libro->id,
            'volumen' => 'nullable|max:50',
            'anio' => 'nullable|digits:4|integer',
            'resumen' => 'nullable',
            'cita' => 'nullable',
            'isbn' => 'nullable|max:20',
            'isbn_coleccion' => 'nullable|max:20',
            'palabras_clave' => 'nullable',
            'resena' => 'nullable',
            'documento' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'estado' => 'required|boolean',
            'series_id' => 'nullable|exists:series,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->titulo);

        // Actualizar imagen si existe
        if($request->hasFile('imagen')){
            $data['imagen'] = $request->file('imagen')->store('libros', 'public');
        }

        $libro->update($data);

        return redirect()->route('admin.libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Eliminar (soft delete) un libro
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('admin.libros.index')->with('success', 'Libro eliminado correctamente.');
    }
}
