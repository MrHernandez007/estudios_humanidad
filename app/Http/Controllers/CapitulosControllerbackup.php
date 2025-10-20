<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Libro;
use App\Models\Autor;
use Illuminate\Http\Request;

class CapitulosController extends Controller
{
    /**
     * Mostrar todos los capítulos
     */
    public function index()
    {
        $capitulos = Capitulo::with(['libro', 'autor'])->latest()->paginate(10);
        return view('admin.capitulos.index', compact('capitulos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $libros = Libro::where('estado', 1)->get();
        $autores = Autor::where('estado', 1)->get();
        return view('admin.capitulos.create', compact('libros', 'autores'));
    }

    /**
     * Guardar un capítulo nuevo
     */
    public function storeviejo(Request $request)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'nombre' => 'required|max:255',
            'autor_id' => 'nullable|exists:autores,id',
            'cita_articulo' => 'nullable',
            'estado' => 'required|boolean',
        ]);

        Capitulo::create($request->all());

        return redirect()->route('admin.capitulos.index')->with('success', 'Capítulo creado correctamente.');
    }

    public function store(Request $request)
{
    $request->validate([
        'libro_id' => 'required|exists:libros,id',
        'nombre' => 'required|max:255',
        'autores' => 'nullable|array',
        'autores.*' => 'exists:autores,id',
        'cita_articulo' => 'nullable',
        'estado' => 'required|boolean',
    ]);

    $capitulo = Capitulo::create($request->only('libro_id','nombre','cita_articulo','estado'));

    if ($request->filled('autores')) {
        $capitulo->autores()->sync($request->autores);
    }

    return redirect()->route('admin.capitulos.index')->with('success', 'Capítulo creado correctamente.');
}


    /**
     * Mostrar un capítulo
     */
    public function show(Capitulo $capitulo)
    {
        return view('admin.capitulos.show', compact('capitulo'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Capitulo $capitulo)
    {
        $libros = Libro::where('estado', 1)->get();
        $autores = Autor::where('estado', 1)->get();
        return view('admin.capitulos.edit', compact('capitulo', 'libros', 'autores'));
    }

    /**
     * Actualizar un capítulo
     */
    public function updateviejo(Request $request, Capitulo $capitulo)
    {
        $request->validate([
            'libro_id' => 'required|exists:libros,id',
            'nombre' => 'required|max:255',
            'autor_id' => 'nullable|exists:autores,id',
            'cita_articulo' => 'nullable',
            'estado' => 'required|boolean',
        ]);

        $capitulo->update($request->all());

        return redirect()->route('admin.capitulos.index')->with('success', 'Capítulo actualizado correctamente.');
    }

    public function update(Request $request, Capitulo $capitulo)
{
    $request->validate([
        'libro_id' => 'required|exists:libros,id',
        'nombre' => 'required|max:255',
        'autores' => 'nullable|array',
        'autores.*' => 'exists:autores,id',
        'cita_articulo' => 'nullable',
        'estado' => 'required|boolean',
    ]);

    $capitulo->update($request->only('libro_id','nombre','cita_articulo','estado'));

    if ($request->filled('autores')) {
        $capitulo->autores()->sync($request->autores);
    } else {
        $capitulo->autores()->sync([]); // eliminar autores si no se selecciona ninguno
    }

    return redirect()->route('admin.capitulos.index')->with('success', 'Capítulo actualizado correctamente.');
}


    /**
     * Eliminar (soft delete) un capítulo
     */
    public function destroy(Capitulo $capitulo)
    {
        $capitulo->delete();
        return redirect()->route('admin.capitulos.index')->with('success', 'Capítulo eliminado correctamente.');
    }
}
