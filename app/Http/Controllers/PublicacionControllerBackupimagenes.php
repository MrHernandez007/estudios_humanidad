<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PublicacionStoreRequest;
use App\Http\Requests\PublicacionUpdateRequest;

class PublicacionController extends Controller
{
    /**
     * Mostrar todas las publicaciones.
     */
    public function index()
    {
        $publicaciones = Publicacion::latest()->paginate(10);
        return view('admin.publicaciones.index', compact('publicaciones'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('admin.publicaciones.create');
    }

    /**
     * Guardar una publicación nueva.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'titulo' => 'required|max:255',
    //         'descripcion' => 'required',
    //         'fecha' => 'required|date',
    //         'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //         'estado' => 'required|boolean',
    //         'tipo' => 'required|in:convocatoria,noticia,evento',
    //     ]);

    //     $data = $request->all();

    //     // Manejo de imagen
    //     if ($request->hasFile('imagen')) {
    //         $data['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
    //     }

    //     Publicacion::create($data);

    //     return redirect()->route('admin.publicaciones.index')->with('success', 'Publicación creada correctamente.');
    // }


    public function store(PublicacionStoreRequest $request)
{
    $data = $request->validated();

    // Manejo de imagen
    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
    }

    Publicacion::create($data);

    return redirect()->route('admin.publicaciones.index')->with('success', 'Publicación creada correctamente.');
}


    /**
     * Mostrar una publicación.
     */
    public function show(Publicacion $publicacione)
    {
        return view('admin.publicaciones.show', compact('publicacione'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Publicacion $publicacione)
    {
        return view('admin.publicaciones.edit', compact('publicacione'));
    }

    /**
     * Actualizar una publicación.
     */
    // public function update(Request $request, Publicacion $publicacione)
    // {
    //     $request->validate([
    //         'titulo' => 'required|max:255',
    //         'descripcion' => 'required',
    //         'fecha' => 'required|date',
    //         'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //         'estado' => 'required|boolean',
    //         'tipo' => 'required|in:convocatoria,noticia,evento',
    //     ]);

    //     $data = $request->all();

    //     // Manejo de imagen (reemplazo si se sube nueva)
    //     if ($request->hasFile('imagen')) {
    //         if ($publicacione->imagen && Storage::disk('public')->exists($publicacione->imagen)) {
    //             Storage::disk('public')->delete($publicacione->imagen);
    //         }
    //         $data['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
    //     }

    //     $publicacione->update($data);

    //     return redirect()->route('admin.publicaciones.index')->with('success', 'Publicación actualizada correctamente.');
    // }

    public function update(PublicacionUpdateRequest $request, Publicacion $publicacione)
{
    $data = $request->validated();

    // Manejo de imagen (reemplazo si se sube nueva)
    if ($request->hasFile('imagen')) {
        if ($publicacione->imagen && Storage::disk('public')->exists($publicacione->imagen)) {
            Storage::disk('public')->delete($publicacione->imagen);
        }
        $data['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
    }

    $publicacione->update($data);

    return redirect()->route('admin.publicaciones.index')->with('success', 'Publicación actualizada correctamente.');
}


    /**
     * Eliminar (soft delete) una publicación.
     */
    public function destroy(Publicacion $publicacione)
    {
        $publicacione->delete();
        return redirect()->route('admin.publicaciones.index')->with('success', 'Publicación eliminada correctamente.');
    }
}
