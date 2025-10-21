<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\CapitulosController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComiteEditorialController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\LibrosPublicController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/ejemplo', function () {
    return view('ejemplo');
});

// Route::get('/EstudiosDeLaHumanidad', function () {
//     return view('General.EstudiosHumanidad.General');
// })->name('estudios.humanidad'); 

// Route::get('/ColecciónEstudiosDelHombre', function () {
//     return view('General.Coleccion_EstudiosHombre.General');
// })->name('estudios.hombre'); 

// Route::get('/RevistaEstudiosDelHombre', function () {
//     return view('General.Revista_EstudiosHombre.General');
// })->name('revista.estudios.hombre'); 

// Route::get('/Inicio', function () {return view('General.Inicio');})->name('inicio.general'); 

Route::get('/Login', function () {
    return view('General.Login');
})->name('login'); 


// Route::get('/Inicio', function () {return view('General.Inicio');})->name('inicio.general'); 
Route::get('/Inicio', [InicioController::class, 'index'])->name('general.inicio');
Route::get('/publicacion/{id}', [InicioController::class, 'publicacionDetalle'])->name('general.publicacion.detalle');




// Route::get('/coleccion', [LibrosPublicController::class, 'index'])->name('general.coleccion');
// Route::get('/coleccion/{id}', [LibrosPublicController::class, 'show'])->name('general.libro.detalle');


// Route::get('/coleccion', [LibrosPublicController::class, 'index'])->name('general.coleccion');
// Route::get('/coleccion/{id}', [LibrosPublicController::class, 'show'])->name('general.libro.detalle');

// Lista de libros filtrados por tipo
Route::get('/coleccion/{tipo}', [LibrosPublicController::class, 'index'])->name('general.coleccion');

// Detalle de un libro
Route::get('/libro/{id}', [LibrosPublicController::class, 'show'])->name('general.libro.detalle');






/************************************************** Admin protegidos ******************************************************/



Route::middleware('auth')->group(function () {

Route::get('/dashboard', function () {return view('admin.dashboard');})->name('dashboard'); 

/* Administradores 
Route::get('/listado', function () {
    return view('Admin.Administradores.listado');
})->name('admin.listado'); */

Route::get('/edicion', function () {
    return view('Admin.Administradores.edicion');})->name('admin.edicion'); 

Route::get('/formulario', function () {
    return view('Admin.Administradores.formulario');})->name('admin.formulario'); 

Route::get('/mostrar', function () {
    return view('Admin.Administradores.mostrar');})->name('admin.mostrar'); 

// ADMINISTRADORES // YA NO SE USA; SE USA ADMIN DE USERS
// Route::get('/administradores', [AdministradorController::class, 'index'])->name('admin.administradores.index');

// // Mostrar formulario de creación
// Route::get('admin/administradores/create', [AdministradorController::class, 'create'])->name('admin.administradores.create');

// // Guardar nueva publicación
// Route::post('admin/administradores', [AdministradorController::class, 'store'])->name('admin.administradores.store');

// // Mostrar una publicación
// Route::get('admin/administradores/{administrador}', [AdministradorController::class, 'show'])->name('admin.administradores.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/administradores/{administrador}/edit', [AdministradorController::class, 'edit'])->name('admin.administradores.edit');

// // Actualizar publicación
// Route::put('admin/administradores/{administrador}', [AdministradorController::class, 'update'])->name('admin.administradores.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/administradores/{administrador}', [AdministradorController::class, 'destroy'])->name('admin.administradores.destroy');

// ADMIN //
/*
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

// Mostrar formulario de creación
Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');

// Guardar nueva publicación
Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');

// Mostrar una publicación
Route::get('admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// Mostrar formulario de edición
Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

// Actualizar publicación
Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

// Eliminar publicación (soft delete)
Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
*/

Route::resource('admin/user',UserController::class)->middleware('auth')->names('admin.users');


// // PUBLICACIONES //

// // Listar publicaciones
// Route::get('admin/publicaciones', [PublicacionController::class, 'index'])->name('admin.publicaciones.index');

// // Mostrar formulario de creación
// Route::get('admin/publicaciones/create', [PublicacionController::class, 'create'])->name('admin.publicaciones.create');

// // Guardar nueva publicación
// Route::post('admin/publicaciones', [PublicacionController::class, 'store'])->name('admin.publicaciones.store');

// // Mostrar una publicación
// Route::get('admin/publicaciones/{publicacione}', [PublicacionController::class, 'show'])->name('admin.publicaciones.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/publicaciones/{publicacione}/edit', [PublicacionController::class, 'edit'])->name('admin.publicaciones.edit');

// // Actualizar publicación
// Route::put('admin/publicaciones/{publicacione}', [PublicacionController::class, 'update'])->name('admin.publicaciones.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/publicaciones/{publicacione}', [PublicacionController::class, 'destroy'])->name('admin.publicaciones.destroy');

// ============================
// PUBLICACIONES
// ============================

// Listar publicaciones
Route::get('admin/publicaciones', [PublicacionController::class, 'index'])->name('admin.publicaciones.index');

// Mostrar formulario de creación
Route::get('admin/publicaciones/create', [PublicacionController::class, 'create'])
    ->name('admin.publicaciones.create')
    ->middleware('permission:Publicaciones Crear');

// Guardar nueva publicación
Route::post('admin/publicaciones', [PublicacionController::class, 'store'])
    ->name('admin.publicaciones.store')
    ->middleware('permission:Publicaciones Crear');

// Mostrar una publicación
Route::get('admin/publicaciones/{publicacione}', [PublicacionController::class, 'show'])
    ->name('admin.publicaciones.show');
    // ->middleware('permission:Publicaciones Ver');

// Mostrar formulario de edición
Route::get('admin/publicaciones/{publicacione}/edit', [PublicacionController::class, 'edit'])
    ->name('admin.publicaciones.edit')
    ->middleware('permission:Publicaciones Editar');

// Actualizar publicación
Route::put('admin/publicaciones/{publicacione}', [PublicacionController::class, 'update'])
    ->name('admin.publicaciones.update')
    ->middleware('permission:Publicaciones Editar');

// Eliminar publicación (soft delete)
Route::delete('admin/publicaciones/{publicacione}', [PublicacionController::class, 'destroy'])
    ->name('admin.publicaciones.destroy')
    ->middleware('permission:Publicaciones Eliminar');



// // SERIES //

// // Listar publicaciones
// Route::get('admin/series', [SeriesController::class, 'index'])->name('admin.series.index');

// // Mostrar formulario de creación
// Route::get('admin/series/create', [SeriesController::class, 'create'])->name('admin.series.create');

// // Guardar nueva publicación
// Route::post('admin/series', [SeriesController::class, 'store'])->name('admin.series.store');

// // Mostrar una publicación
// Route::get('admin/series/{serie}', [SeriesController::class, 'show'])->name('admin.series.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/series/{serie}/edit', [SeriesController::class, 'edit'])->name('admin.series.edit');

// // Actualizar publicación
// Route::put('admin/series/{serie}', [SeriesController::class, 'update'])->name('admin.series.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/series/{serie}', [SeriesController::class, 'destroy'])->name('admin.series.destroy');

// ============================
// SERIES
// ============================

// Listar series
Route::get('admin/series', [SeriesController::class, 'index'])->name('admin.series.index');

// Mostrar formulario de creación
Route::get('admin/series/create', [SeriesController::class, 'create'])
    ->name('admin.series.create')
    ->middleware('permission:Series Crear');

// Guardar nueva serie
Route::post('admin/series', [SeriesController::class, 'store'])
    ->name('admin.series.store')
    ->middleware('permission:Series Crear');

// Mostrar una serie
Route::get('admin/series/{serie}', [SeriesController::class, 'show'])
    ->name('admin.series.show');
    // ->middleware('permission:Series Ver');

// Mostrar formulario de edición
Route::get('admin/series/{serie}/edit', [SeriesController::class, 'edit'])
    ->name('admin.series.edit')
    ->middleware('permission:Series Editar');

// Actualizar serie
Route::put('admin/series/{serie}', [SeriesController::class, 'update'])
    ->name('admin.series.update')
    ->middleware('permission:Series Editar');

// Eliminar serie (soft delete)
Route::delete('admin/series/{serie}', [SeriesController::class, 'destroy'])
    ->name('admin.series.destroy')
    ->middleware('permission:Series Eliminar');



// // TIPOS //

// // Listar tipos
// Route::get('admin/tipos', [TiposController::class, 'index'])->name('admin.tipos.index');

// // Mostrar formulario de creación
// Route::get('admin/tipos/create', [TiposController::class, 'create'])->name('admin.tipos.create');

// // Guardar nuevo tipo
// Route::post('admin/tipos', [TiposController::class, 'store'])->name('admin.tipos.store');

// // Mostrar un tipo
// Route::get('admin/tipos/{tipo}', [TiposController::class, 'show'])->name('admin.tipos.show');

// // Mostrar formulario de edición
// Route::get('admin/tipos/{tipo}/edit', [TiposController::class, 'edit'])->name('admin.tipos.edit');

// // Actualizar tipo
// Route::put('admin/tipos/{tipo}', [TiposController::class, 'update'])->name('admin.tipos.update');

// // Eliminar tipo (soft delete)
// Route::delete('admin/tipos/{tipo}', [TiposController::class, 'destroy'])->name('admin.tipos.destroy');

// ============================
// TIPOS
// ============================

// Listar tipos
Route::get('admin/tipos', [TiposController::class, 'index'])->name('admin.tipos.index');

// Mostrar formulario de creación
Route::get('admin/tipos/create', [TiposController::class, 'create'])
    ->name('admin.tipos.create')
    ->middleware('permission:Tipos Crear');

// Guardar nuevo tipo
Route::post('admin/tipos', [TiposController::class, 'store'])
    ->name('admin.tipos.store')
    ->middleware('permission:Tipos Crear');

// Mostrar un tipo
Route::get('admin/tipos/{tipo}', [TiposController::class, 'show'])
    ->name('admin.tipos.show');
    // ->middleware('permission:Tipos Ver');

// Mostrar formulario de edición
Route::get('admin/tipos/{tipo}/edit', [TiposController::class, 'edit'])
    ->name('admin.tipos.edit')
    ->middleware('permission:Tipos Editar');

// Actualizar tipo
Route::put('admin/tipos/{tipo}', [TiposController::class, 'update'])
    ->name('admin.tipos.update')
    ->middleware('permission:Tipos Editar');

// Eliminar tipo (soft delete)
Route::delete('admin/tipos/{tipo}', [TiposController::class, 'destroy'])
    ->name('admin.tipos.destroy')
    ->middleware('permission:Tipos Eliminar');




// // AUTORES //

// // Listar publicaciones
// Route::get('admin/autores', [AutoresController::class, 'index'])->name('admin.autores.index');

// // Mostrar formulario de creación
// Route::get('admin/autores/create', [AutoresController::class, 'create'])->name('admin.autores.create');

// // Guardar nueva publicación
// Route::post('admin/autores', [AutoresController::class, 'store'])->name('admin.autores.store');

// // Mostrar una publicación
// Route::get('admin/autores/{autor}', [AutoresController::class, 'show'])->name('admin.autores.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/autores/{autor}/edit', [AutoresController::class, 'edit'])->name('admin.autores.edit');

// // Actualizar publicación
// Route::put('admin/autores/{autor}', [AutoresController::class, 'update'])->name('admin.autores.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/autores/{autor}', [AutoresController::class, 'destroy'])->name('admin.autores.destroy');

// ====================
// AUTORES
// ====================


    // Listar autores
    Route::get('admin/autores', [AutoresController::class, 'index'])->name('admin.autores.index');


    // Mostrar formulario de creación
    Route::get('admin/autores/create', [AutoresController::class, 'create'])
        ->name('admin.autores.create')
        ->middleware('permission:Autores Crear');

    // Guardar nuevo autor
    Route::post('admin/autores', [AutoresController::class, 'store'])
        ->name('admin.autores.store')
        ->middleware('permission:Autores Crear');

    // Mostrar un autor
    Route::get('admin/autores/{autor}', [AutoresController::class, 'show'])
        ->name('admin.autores.show');
        //->middleware('permission:Autores Ver'); no se pone porque todos tienen este permiso

    // Mostrar formulario de edición
    Route::get('admin/autores/{autor}/edit', [AutoresController::class, 'edit'])
        ->name('admin.autores.edit')
        ->middleware('permission:Autores Editar');

    // Actualizar autor
    Route::put('admin/autores/{autor}', [AutoresController::class, 'update'])
        ->name('admin.autores.update')
        ->middleware('permission:Autores Editar');

    // Eliminar autor
    Route::delete('admin/autores/{autor}', [AutoresController::class, 'destroy'])
        ->name('admin.autores.destroy')
        ->middleware('permission:Autores Eliminar');





// // LIBROS //

// // Listar publicaciones
// Route::get('admin/libros', [LibrosController::class, 'index'])->name('admin.libros.index');

// // Mostrar formulario de creación
// Route::get('admin/libros/create', [LibrosController::class, 'create'])->name('admin.libros.create');

// // Guardar nueva publicación
// Route::post('admin/libros', [LibrosController::class, 'store'])->name('admin.libros.store');

// // Mostrar una publicación
// Route::get('admin/libros/{libro}', [LibrosController::class, 'show'])->name('admin.libros.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/libros/{libro}/edit', [LibrosController::class, 'edit'])->name('admin.libros.edit');

// // Actualizar publicación
// Route::put('admin/libros/{libro}', [LibrosController::class, 'update'])->name('admin.libros.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/libros/{libro}', [LibrosController::class, 'destroy'])->name('admin.libros.destroy');

// ====================
// LIBROS
// ====================


// Listar libros - cualquiera autenticado puede ver
    Route::get('admin/libros', [LibrosController::class, 'index'])->name('admin.libros.index');

    // Crear libro
    Route::get('admin/libros/create', [LibrosController::class, 'create'])
        ->name('admin.libros.create')
        ->middleware('permission:Libros Crear');

    Route::post('admin/libros', [LibrosController::class, 'store'])
        ->name('admin.libros.store')
        ->middleware('permission:Libros Crear');

    // Mostrar libro
    Route::get('admin/libros/{libro}', [LibrosController::class, 'show'])
        ->name('admin.libros.show');

    // Editar libro
    Route::get('admin/libros/{libro}/edit', [LibrosController::class, 'edit'])
        ->name('admin.libros.edit')
        ->middleware('permission:Libros Editar');

    Route::put('admin/libros/{libro}', [LibrosController::class, 'update'])
        ->name('admin.libros.update')
        ->middleware('permission:Libros Editar');

    // Eliminar libro
    Route::delete('admin/libros/{libro}', [LibrosController::class, 'destroy'])
        ->name('admin.libros.destroy')
        ->middleware('permission:Libros Eliminar');

// // CAPITULOS //

// // Listar publicaciones
// Route::get('admin/capitulos', [CapitulosController::class, 'index'])->name('admin.capitulos.index');

// // Mostrar formulario de creación
// Route::get('admin/capitulos/create', [CapitulosController::class, 'create'])->name('admin.capitulos.create');

// // Guardar nueva publicación
// Route::post('admin/capitulos', [CapitulosController::class, 'store'])->name('admin.capitulos.store');

// // Mostrar una publicación
// Route::get('admin/capitulos/{capitulo}', [CapitulosController::class, 'show'])->name('admin.capitulos.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/capitulos/{capitulo}/edit', [CapitulosController::class, 'edit'])->name('admin.capitulos.edit');

// // Actualizar publicación
// Route::put('admin/capitulos/{capitulo}', [CapitulosController::class, 'update'])->name('admin.capitulos.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/capitulos/{capitulo}', [CapitulosController::class, 'destroy'])->name('admin.capitulos.destroy');


// ====================
// CAPÍTULOS
// ====================

// Listar capítulos
Route::get('admin/capitulos', [CapitulosController::class, 'index'])->name('admin.capitulos.index');

// Mostrar formulario de creación
Route::get('admin/capitulos/create', [CapitulosController::class, 'create'])
    ->name('admin.capitulos.create')
    ->middleware('permission:Capitulos Crear');

// Guardar nuevo capítulo
Route::post('admin/capitulos', [CapitulosController::class, 'store'])
    ->name('admin.capitulos.store')
    ->middleware('permission:Capitulos Crear');

// Mostrar un capítulo
Route::get('admin/capitulos/{capitulo}', [CapitulosController::class, 'show'])
    ->name('admin.capitulos.show');
    // ->middleware('permission:Capitulos Ver');

// Mostrar formulario de edición
Route::get('admin/capitulos/{capitulo}/edit', [CapitulosController::class, 'edit'])
    ->name('admin.capitulos.edit')
    ->middleware('permission:Capitulos Editar');

// Actualizar capítulo
Route::put('admin/capitulos/{capitulo}', [CapitulosController::class, 'update'])
    ->name('admin.capitulos.update')
    ->middleware('permission:Capitulos Editar');

// Eliminar capítulo
Route::delete('admin/capitulos/{capitulo}', [CapitulosController::class, 'destroy'])
    ->name('admin.capitulos.destroy')
    ->middleware('permission:Capitulos Eliminar');



// // COMITE_EDITORIAL //

// // Listar publicaciones
// Route::get('admin/comite_editorial', [ComiteEditorialController::class, 'index'])->name('admin.comite_editorial.index');

// // Mostrar formulario de creación
// Route::get('admin/comite_editorial/create', [ComiteEditorialController::class, 'create'])->name('admin.comite_editorial.create');

// // Guardar nueva publicación
// Route::post('admin/comite_editorial', [ComiteEditorialController::class, 'store'])->name('admin.comite_editorial.store');

// // Mostrar una publicación
// Route::get('admin/comite_editorial/{comite_editorial}', [ComiteEditorialController::class, 'show'])->name('admin.comite_editorial.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/comite_editorial/{comite_editorial}/edit', [ComiteEditorialController::class, 'edit'])->name('admin.comite_editorial.edit');

// // Actualizar publicación
// Route::put('admin/comite_editorial/{comite_editorial}', [ComiteEditorialController::class, 'update'])->name('admin.comite_editorial.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/comite_editorial/{comite_editorial}', [ComiteEditorialController::class, 'destroy'])->name('admin.comite_editorial.destroy');

// ============================
// COMITÉ EDITORIAL
// ============================

// Listar Comité Editorial
Route::get('admin/comite_editorial', [ComiteEditorialController::class, 'index'])->name('admin.comite_editorial.index');

// Mostrar formulario de creación
Route::get('admin/comite_editorial/create', [ComiteEditorialController::class, 'create'])
    ->name('admin.comite_editorial.create')
    ->middleware('permission:Comite_Editorial Crear');

// Guardar nuevo registro
Route::post('admin/comite_editorial', [ComiteEditorialController::class, 'store'])
    ->name('admin.comite_editorial.store')
    ->middleware('permission:Comite_Editorial Crear');

// Mostrar un registro individual
Route::get('admin/comite_editorial/{comite_editorial}', [ComiteEditorialController::class, 'show'])
    ->name('admin.comite_editorial.show');
    // ->middleware('permission:Comite_Editorial Ver');

// Mostrar formulario de edición
Route::get('admin/comite_editorial/{comite_editorial}/edit', [ComiteEditorialController::class, 'edit'])
    ->name('admin.comite_editorial.edit')
    ->middleware('permission:Comite_Editorial Editar');

// Actualizar registro
Route::put('admin/comite_editorial/{comite_editorial}', [ComiteEditorialController::class, 'update'])
    ->name('admin.comite_editorial.update')
    ->middleware('permission:Comite_Editorial Editar');

// Eliminar (soft delete)
Route::delete('admin/comite_editorial/{comite_editorial}', [ComiteEditorialController::class, 'destroy'])
    ->name('admin.comite_editorial.destroy')
    ->middleware('permission:Comite_Editorial Eliminar');


// ============================
// ROLES
// ============================



// Route::prefix('admin')->name('admin.')->group(function () {
//     // CRUD Roles
//     Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
//     Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
//     Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
//     Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');
//     Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
//     Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
//     Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

//     // Permisos
//     Route::get('roles/{role}/permissions', [RoleController::class, 'editPermissions'])
//         ->name('roles.editPermissions');
//     Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
//         ->name('roles.updatePermissions');
// });

// ============================
// ROLES
// ============================

// Listar roles
Route::get('admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');

// Mostrar formulario de creación
Route::get('admin/roles/create', [RoleController::class, 'create'])
    ->name('admin.roles.create');
    // ->middleware('permission:Roles Crear');

// Guardar nuevo rol
Route::post('admin/roles', [RoleController::class, 'store'])
    ->name('admin.roles.store');
    // ->middleware('permission:Roles Crear');

// Mostrar un rol
Route::get('admin/roles/{role}', [RoleController::class, 'show'])
    ->name('admin.roles.show');
    // ->middleware('permission:Roles Ver');

// Mostrar formulario de edición
Route::get('admin/roles/{role}/edit', [RoleController::class, 'edit'])
    ->name('admin.roles.edit');
    // ->middleware('permission:Roles Editar');

// Actualizar rol
Route::put('admin/roles/{role}', [RoleController::class, 'update'])
    ->name('admin.roles.update');
    // ->middleware('permission:Roles Editar');

// Eliminar rol
Route::delete('admin/roles/{role}', [RoleController::class, 'destroy'])
    ->name('admin.roles.destroy')
    ->middleware('permission:Roles Eliminar');

// Editar permisos de rol
Route::get('admin/roles/{role}/permissions', [RoleController::class, 'editPermissions'])
    ->name('admin.roles.editPermissions');
    // ->middleware('permission:Roles Editar');

Route::put('admin/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
    ->name('admin.roles.updatePermissions');
    // ->middleware('permission:Roles Editar');







// // ROLES //

// // Listar publicaciones
// Route::get('admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');

// // Mostrar formulario de creación
// Route::get('admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');

// // Guardar nueva publicación
// Route::post('admin/roles', [RoleController::class, 'store'])->name('admin.roles.store');

// // Mostrar una publicación
// Route::get('admin/roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');

// // Actualizar publicación
// Route::put('admin/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');


// // Permisos
//     Route::get('roles/{role}/permissions', [RoleController::class, 'editPermissions'])
//         ->name('roles.editPermissions');
//     Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
//         ->name('roles.updatePermissions');
        


//         Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('roles', RoleController::class);

//     // Permisos
//     Route::get('roles/{role}/permissions', [RoleController::class, 'editPermissions'])
//         ->name('roles.editPermissions');
//     Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
//         ->name('roles.updatePermissions');
// });



// // PERMISSONS //

// // Listar publicaciones
// Route::get('admin/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');

// // Mostrar formulario de creación
// Route::get('admin/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');

// // Guardar nueva publicación
// Route::post('admin/permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');

// // Mostrar una publicación
// Route::get('admin/permissions/{permission}', [PermissionController::class, 'show'])->name('admin.permissions.show'); // Route::get('Amenidades_Desarrollos/{id}/editar actualizar y borrar

// // Mostrar formulario de edición
// Route::get('admin/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');

// // Actualizar publicación
// Route::put('admin/permissions/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');

// // Eliminar publicación (soft delete)
// Route::delete('admin/permissions/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

// ============================
// PERMISSIONS
// ============================

// Listar permisos
Route::get('admin/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');

// Mostrar formulario de creación
Route::get('admin/permissions/create', [PermissionController::class, 'create'])
    ->name('admin.permissions.create')
    ->middleware('permission:Permissions Crear');

// Guardar nuevo permiso
Route::post('admin/permissions', [PermissionController::class, 'store'])
    ->name('admin.permissions.store')
    ->middleware('permission:Permissions Crear');

// Mostrar un permiso
Route::get('admin/permissions/{permission}', [PermissionController::class, 'show'])
    ->name('admin.permissions.show');
    // ->middleware('permission:Permisos Ver');

// Mostrar formulario de edición
Route::get('admin/permissions/{permission}/edit', [PermissionController::class, 'edit'])
    ->name('admin.permissions.edit')
    ->middleware('permission:Permissions Editar');

// Actualizar permiso
Route::put('admin/permissions/{permission}', [PermissionController::class, 'update'])
    ->name('admin.permissions.update')
    ->middleware('permission:Permissions Editar');

// Eliminar permiso (soft delete)
Route::delete('admin/permissions/{permission}', [PermissionController::class, 'destroy'])
    ->name('admin.permissions.destroy')
    ->middleware('permission:Permissions Eliminar');

// Opcional: si quieres un botón extra para "editar roles asignados a permisos"
// Route::get('admin/permissions/{permission}/editRoles', [PermissionController::class, 'editRoles'])
//      ->name('admin.permissions.editRoles')
//      ->middleware('permission:Permisos Editar');



});



//login???// 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); //VERIFICAR ES PARA EL DASHBOARD DESOUES DEL LOGIN ME MNADA A HOME NO A DASH 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
