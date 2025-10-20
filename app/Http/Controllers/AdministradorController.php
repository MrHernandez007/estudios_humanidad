<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class AdministradorController extends Controller
{
    public function indexviejo()
    {
        // Obtiene todos los administradores con su rol
        $administradores = Administrador::with('rol')->get();

        return view('admin.administradores.index', compact('administradores'));

    }

    public function index()
    {
        // Obtiene todos los administradores con su rol
        $administrador = Administrador::paginate(10);

        return view('admin.administradores.index', compact('administrador'));

    }

    public function create()
    {
        return view('admin.administradores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol_id' => 'required|integer|in:1,2',
            'estado' => 'required|boolean',
        ]);

        Administrador::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador creado correctamente.');
    }

    public function show(Administrador $administrador)
    {
        return view('admin.administradores.show', compact('administrador'));
    }

    public function edit(Administrador $administrador)
    {
        return view('admin.administradores.edit', compact('administrador'));
    }

    public function update(Request $request, Administrador $administrador)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $administrador->id,
            'password' => 'nullable|string|min:6|confirmed',
            'rol_id' => 'required|integer|in:1,2',
            'estado' => 'required|boolean',
        ]);

        $administrador->name = $request->name;
        $administrador->email = $request->email;
        $administrador->rol_id = $request->rol_id;
        $administrador->estado = $request->estado;

        if ($request->password) {
            $administrador->password = Hash::make($request->password);
        }

        $administrador->save();

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador actualizado correctamente.');
    }

    public function destroy(Administrador $administradores)
    {
        $administradores->delete();
        return redirect()->route('admin.administradores.index')->with('success', 'Administrador eliminado correctamente.');
    }
}
