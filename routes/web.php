<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DirecionController;
use App\Http\Controllers\AdministradorController;


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [UsuarioController::class, 'home'])->name('usuarios.home');

Route::get('/repartidores/crear', [AdministradorController::class, 'repartidores'])->name('repartidores.crear');
Route::post('/repartidores/crear', [AdministradorController::class, 'crearRepartidor'])->name('repartidores.crear.post');
Route::get('/repartidores/eliminar/{id}', [AdministradorController::class, 'eliminarRepartidor'])->name('repartidores.eliminar');

Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');
Route::post('/usuarios/login', [usuarioController::class, 'login'])->name('usuario.login');
Route::get('/productos/ver/{id}', [ProductoController::class, 'ver'])->name('productos.ver');
Route::get('/productos/ver/{id}', [ProductoController::class, 'ver'])->name('productos.ver');
Route::get('/productos/crear', [ProductoController::class, 'mostrar'])->name('productos.crear');
Route::post('productos/crear', [ProductoController::class, 'crear'])->name('productos.crear.post');
Route::get('/productos/eliminar/{id}', [ProductoController::class, 'eliminar'])->name('productos.eliminar');
Route::post('/productos/modificar', [ProductoController::class, 'modificar'])->name('productos.modificar');

Route::get('/usuarios/ver/{id}', [UsuarioController::class, 'ver'])->name('usuarios.ver');
Route::get('/usuarios/login', [UsuarioController::class, 'login'])->name('usuarios.login');
Route::get('/usuarios/crear', [UsuarioController::class, 'mostrar'])->name('usuarios.crear');
Route::post('/usuarios/crear', [UsuarioController::class, 'crear'])->name('usuarios.crear.post');
Route::post('/usuarios/modificar', [UsuarioController::class, 'modificar'])->name('usuarios.modificar');

Route::get('/administrador/home', [AdministradorController::class, 'home'])->name('administrador.home');
Route::get('/administrador/usuarios', [AdministradorController::class, 'usuarios'])->name('administrador.usuarios');
Route::get('/administrador/detalleorden', [AdministradorController::class, 'detalleorden'])->name('administrador.detalleorden');
Route::get('/administrador/eliminar/{id}', [AdministradorController::class, 'eliminarUsuario'])->name('administrador.eliminarUsuario');

Route::get('/ordenes', [AdministradorController::class, 'ordenes'])->name('administrador.ordenes');
Route::get('/orden/{id}', [AdministradorController::class, 'verOrden'])->name('administrador.verOrden');
Route::post('/orden/guardar', [AdministradorController::class, 'guardarOrden'])->name('administrador.guardarOrden');
Route::post('/orden/asignar', [AdministradorController::class, 'asignarPedido'])->name('administrador.asignarPedido');

Route::post('/generar-orden', [UsuarioController::class, 'generarOrden'])->name('usuario.generarOrden');
Route::post('/vaciar-carrito', [UsuarioController::class, 'vaciarCarrito'])->name('usuario.vaciarCarrito');
Route::get('/carrito/{usuarioId}', [UsuarioController::class, 'obtenerCarrito'])->name('usuario.obtenerCarrito');
Route::post('/agregar-al-carrito', [UsuarioController::class, 'agregarAlCarrito'])->name('usuario.agregarAlCarrito');
Route::delete('/eliminar-del-carrito', [UsuarioController::class, 'eliminarDelCarrito'])->name('usuario.eliminarDelCarrito');

Route::get('/metodopago/ver/{id}', [UsuarioController::class, 'verMetodoPago'])->name('usuario.verMetodoPago');
Route::get('/metodopago/listar', [UsuarioController::class, 'mostrarMetodoPago'])->name('usuario.mostrarMetodoPago');
Route::post('/metodopago/guardar', [UsuarioController::class, 'guardarMetodoPago'])->name('usuario.guardarMetodoPago');
Route::put('/metodopago/modificar', [UsuarioController::class, 'modificarMetodoPago'])->name('usuario.modificarMetodoPago');