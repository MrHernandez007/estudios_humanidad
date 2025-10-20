<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SerieStoreRequest;
use App\Http\Requests\SerieUpdateRequest;

class SeriesController extends Controller
{
    /**
     * Mostrar todas las series.
     */
    public function index()
    {
        $series = Serie::latest()->paginate(10);
        return view('admin.series.index', compact('series'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('admin.series.create');
    }

    /**
     * Guardar una serie nueva.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nombre' => 'required|max:255|unique:series,nombre',
    //         'descripcion' => 'nullable',
    //         'estado' => 'required|boolean',
    //     ]);

    //     Serie::create($request->all());

    //     return redirect()->route('admin.series.index')->with('success', 'Serie creada correctamente.');
    // }

    public function store(SerieStoreRequest $request)
{
    Serie::create($request->validated());

    return redirect()->route('admin.series.index')->with('success', 'Serie creada correctamente.');
}


    /**
     * Mostrar una serie.
     */
    public function show(Serie $serie)
    {
        return view('admin.series.show', compact('serie'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Serie $serie)
    {
        return view('admin.series.edit', compact('serie'));
    }

    /**
     * Actualizar una serie.
     */
    // public function update(Request $request, Serie $serie)
    // {
    //     $request->validate([
    //         'nombre' => 'required|max:255|unique:series,nombre,'.$serie->id,
    //         'descripcion' => 'nullable',
    //         'estado' => 'required|boolean',
    //     ]);

    //     $serie->update($request->all());

    //     return redirect()->route('admin.series.index')->with('success', 'Serie actualizada correctamente.');
    // }

    public function update(SerieUpdateRequest $request, Serie $serie)
{
    $serie->update($request->validated());

    return redirect()->route('admin.series.index')->with('success', 'Serie actualizada correctamente.');
}


    /**
     * Eliminar (soft delete) una serie.
     */
    public function destroy(Serie $serie)
    {
        $serie->delete();
        return redirect()->route('admin.series.index')->with('success', 'Serie eliminada correctamente.');
    }
}
