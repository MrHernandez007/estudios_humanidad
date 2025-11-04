<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Requests\AutorStoreRequest;
use App\Http\Requests\AutorUpdateRequest;

class AutoresController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Autores Crear')->only(['create', 'store']);
        $this->middleware('permission:Autores Editar')->only(['edit', 'update']);
        $this->middleware('permission:Autores Eliminar')->only(['destroy']);
    }

    /**~
     * Mostrar todos los autores
     */
   

    public function index()
{
    $autores = Autor::orderBy('nombre', 'asc')->paginate(10);
    return view('admin.autores.index', compact('autores'));
}


    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.autores.create');
    }

    /**
     * Guardar un autor nuevo
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nombre' => 'required|max:100',
    //         'apellido' => 'required|max:100',
    //         'estado' => 'required|boolean',
    //     ]);

    //     Autor::create($request->all());

    //     return redirect()->route('admin.autores.index')->with('success', 'Autor creado correctamente.');
    // }

    public function store(AutorStoreRequest $request)
    {
        Autor::create($request->validated());

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor creado correctamente.');
    }

    /**
     * Mostrar un autor
     */
    public function show(Autor $autor)
    {
        return view('admin.autores.show', compact('autor'));
        
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Autor $autor)
    {
        // dd(auth()->user());
        return view('admin.autores.edit', compact('autor'));
    }

    /**
     * Actualizar un autor
     */
    // public function update(Request $request, Autor $autor)
    // {
    //     $request->validate([
    //         'nombre' => 'required|max:100',
    //         'apellido' => 'required|max:100',
    //         'estado' => 'required|boolean',
    //     ]);

    //     $autor->update($request->all());

    //     return redirect()->route('admin.autores.index')->with('success', 'Autor actualizado correctamente.');
    // }

    public function update(AutorUpdateRequest $request, Autor $autor)
    {
        $autor->update($request->validated());

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor actualizado correctamente.');
    }

    /**
     * Eliminar (soft delete) un autor
     */
    public function destroy(Autor $autor)
    {
        $autor->delete();
        return redirect()->route('admin.autores.index')->with('success', 'Autor eliminado correctamente.');
    }
}
