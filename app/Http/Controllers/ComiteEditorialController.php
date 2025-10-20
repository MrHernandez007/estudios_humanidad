<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ComiteEditorial;
use Illuminate\Http\Request;
use App\Http\Requests\ComiteEditorialStoreRequest;
use App\Http\Requests\ComiteEditorialUpdateRequest;

class ComiteEditorialController extends Controller
{
    
    /**
     * Mostrar listado de miembros del comité editorial.
     */
    public function index()
    {
//         $user = auth()->user();
// dd($user->getAllPermissions()->pluck('name'));

        $comite = ComiteEditorial::orderBy('id', 'desc')->paginate(10);
        return view('admin.comite_editorial.index', compact('comite'));
    }

    /**
     * Mostrar formulario para crear un nuevo miembro.
     */
    public function create()
    {
        return view('admin.comite_editorial.create');
    }

    /**
     * Guardar nuevo miembro en la BD.
     */

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nombre'      => 'required|string|max:255',
    //         'apellido'    => 'required|string|max:255',
    //         'dependencia' => 'required|string|max:255',
    //         'pais'        => 'required|string|max:255',
    //         'estado'      => 'required|boolean',
    //     ]);

    //     ComiteEditorial::create($request->all());

    //     return redirect()->route('admin.comite_editorial.index')
    //                      ->with('success', 'Miembro agregado correctamente.');
    // }

    public function store(ComiteEditorialStoreRequest $request)
    {
        ComiteEditorial::create($request->validated());

        return redirect()->route('admin.comite_editorial.index')
            ->with('success', 'Miembro agregado correctamente.');
    }

    /**
     * Mostrar detalles de un miembro.
     */
    public function show(ComiteEditorial $comite_editorial)
    {
        return view('admin.comite_editorial.show', ['miembro' => $comite_editorial]);
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(ComiteEditorial $comite_editorial)
    {
        return view('admin.comite_editorial.edit', ['miembro' => $comite_editorial]);
    }

    /**
     * Actualizar datos de un miembro.
     */

    // public function update(Request $request, ComiteEditorial $comite_editorial)
    // {
    //     $request->validate([
    //         'nombre'      => 'required|string|max:255',
    //         'apellido'    => 'required|string|max:255',
    //         'dependencia' => 'required|string|max:255',
    //         'pais'        => 'required|string|max:255',
    //         'estado'      => 'required|boolean',
    //     ]);

    //     $comite_editorial->update($request->all());

    //     return redirect()->route('admin.comite_editorial.index')
    //                      ->with('success', 'Miembro actualizado correctamente.');
    // }


    public function update(ComiteEditorialUpdateRequest $request, ComiteEditorial $comiteEditorial)
{
    $comiteEditorial->update($request->validated());

    return redirect()->route('admin.comite_editorial.index')
        ->with('success', 'Miembro actualizado correctamente.');
}

    /**
     * Eliminar (soft delete) un miembro.
     */
    public function destroy(ComiteEditorial $comite_editorial)
    {
        $comite_editorial->delete();

        return redirect()->route('admin.comite_editorial.index')
                         ->with('success', 'Miembro eliminado correctamente.');
    }
}
