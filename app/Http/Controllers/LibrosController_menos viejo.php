<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Serie;
use App\Models\Autor;
use App\Models\Tipo;
use App\Models\LibroAutor; //creo que no es necesario
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\LibroStoreRequest;
use App\Http\Requests\LibroUpdateRequest;

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
    $series = Serie::where('estado', 1)->get();
    $autores = Autor::all(); // todos los autores
    $tipos = Tipo::all(); // todos los tipos
    return view('admin.libros.create', compact('series', 'autores', 'tipos'));
}

    /**
     * Guardar un libro nuevo
     */
//     public function store(Request $request)
// {
//     $request->validate([
//         'titulo' => 'required|max:255|unique:libros,titulo',
//         'volumen' => 'nullable|max:50',
//         'anio' => 'nullable|digits:4|integer',
//         'resumen' => 'nullable',
//         'cita' => 'nullable',
//         'isbn' => 'nullable|max:20',
//         'isbn_coleccion' => 'nullable|max:20',
//         'palabras_clave' => 'nullable',
//         'resena' => 'nullable',
//         'documento' => 'nullable',
//         'estado' => 'required|boolean',
//         'series_id' => 'nullable|exists:series,id',
//         'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
//         'roles' => 'nullable|array',
//     ]);

//     $data = $request->except('roles');
//     $data['slug'] = Str::slug($request->titulo);

//     if($request->hasFile('imagen')){
//         $data['imagen'] = $request->file('imagen')->store('libros', 'public');
//     }

//     $libro = Libro::create($data);

//     if ($request->filled('roles')) {
//     $attachData = [];
//     foreach ($request->roles as $r) {
//         $autorId = $r['autor_id'];
//         if (!$autorId) continue;
//         foreach ($r['roles'] as $rol) {
//             $attachData[] = [
//                 'autor_id' => $autorId,
//                 'rol' => $rol,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ];
//         }
//     }
//     $libro->autores()->detach();
//     $libro->autores()->attach($attachData);
// }


//     return redirect()->route('admin.libros.index')->with('success', 'Libro creado correctamente.');
// }


    public function store(LibroStoreRequest $request)
    {
        $data = $request->except('roles');
        $data['slug'] = Str::slug($request->titulo);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('libros', 'public');
        }

        $libro = Libro::create($data);

        if ($request->filled('roles')) {
            $attachData = [];
            foreach ($request->roles as $r) {
                $autorId = $r['autor_id'];
                if (!$autorId) continue;
                foreach ($r['roles'] as $rol) {
                    $attachData[] = [
                        'autor_id' => $autorId,
                        'rol' => $rol,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            $libro->autores()->detach();
            $libro->autores()->attach($attachData);
        }

        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro creado correctamente.');
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
    $series = Serie::where('estado', 1)->get();
    $autores = Autor::all();
    $libro->load('autores'); // cargar relación
    $tipos = Tipo::all();
    return view('admin.libros.edit', compact('libro', 'series', 'autores', 'tipos'));
}

    /**
     * Actualizar un libro
     */
//     public function update(Request $request, Libro $libro)
// {
//     $request->validate([
//         'titulo' => 'required|max:255|unique:libros,titulo,'.$libro->id,
//         'volumen' => 'nullable|max:50',
//         'anio' => 'nullable|digits:4|integer',
//         'resumen' => 'nullable',
//         'cita' => 'nullable',
//         'isbn' => 'nullable|max:20',
//         'isbn_coleccion' => 'nullable|max:20',
//         'palabras_clave' => 'nullable',
//         'resena' => 'nullable',
//         'documento' => 'nullable',
//         'estado' => 'required|boolean',
//         'series_id' => 'nullable|exists:series,id',
//         'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
//         'roles' => 'nullable|array',
//     ]);

//     $data = $request->except('roles');
//     $data['slug'] = Str::slug($request->titulo);

//     if($request->hasFile('imagen')){
//         $data['imagen'] = $request->file('imagen')->store('libros', 'public');
//     }

//     $libro->update($data);

//     // Actualizar autores y roles
//     $libro->autores()->detach();
//     if ($request->filled('roles')) {
//         $attachData = [];
//         foreach ($request->roles as $r) {
//             $autorId = $r['autor_id'];
//             if (!$autorId) continue;
//             foreach ($r['roles'] as $rol) {
//                 $attachData[] = [
//                     'autor_id' => $autorId,
//                     'rol' => $rol,
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ];
//             }
//         }
//         $libro->autores()->attach($attachData);
//     }

//     return redirect()->route('admin.libros.index')->with('success', 'Libro actualizado correctamente.');
// }

    public function update(LibroUpdateRequest $request, Libro $libro)
{
    $data = $request->except('roles');
    $data['slug'] = Str::slug($request->titulo);

    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store('libros', 'public');
    }

    $libro->update($data);

    if ($request->filled('roles')) {
        foreach ($request->roles as $r) {
            $autorId = $r['autor_id'];
            if (!$autorId) continue;

            foreach ($r['roles'] as $rol) {
                // Usamos syncWithoutDetaching para no borrar lo existente
                $libro->autores()->syncWithoutDetaching([
                    $autorId => ['rol' => $rol, 'created_at' => now(), 'updated_at' => now()]
                ]);
            }
        }
    }

    return redirect()->route('admin.libros.index')
        ->with('success', 'Libro actualizado correctamente.');
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
