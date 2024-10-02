<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Ajusta la ruta de 'memeba' para usar el controlador
Route::get('memeba', [ProductoController::class, 'index'])->name('memeba.index');

// Recurso para productos
Route::resource('productos', ProductoController::class);

Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');
Route::post('/pagar', [CarritoController::class, 'procesarPago'])->name('carrito.pagar');   
Route::post('/carrito/actualizar/{index}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/producto/{id}/comprar', [ProductoController::class, 'generarClave'])->name('producto.comprar');

Route::delete('/carrito/eliminar/{index}', [CarritoController::class, 'eliminarProducto'])->name('carrito.eliminar');

// Rutas de autenticación
Route::get('/login', [UserController::class, 'showLoginForm'])->name('usuarios.login');
Route::post('/login', [UserController::class, 'login'])->name('usuarios.login.submit');
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('usuarios.register');
Route::post('/register', [UserController::class, 'register'])->name('usuarios.register.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
