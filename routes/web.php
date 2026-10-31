<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return redirect()->route('alojamientos.index');
});

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Gestión de alojamientos
/// Administración de alojamientos (requiere iniciar sesión)
Route::middleware('auth')->group(function () {
    Route::resource('alojamientos', AlojamientoController::class)
        ->except(['index', 'show']);
});

// Consulta pública de alojamientos
Route::resource('alojamientos', AlojamientoController::class)
    ->only(['index', 'show']);


// Gestión de reservas (solo usuarios autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/reservas', [ReservaController::class, 'index'])
        ->name('reservas.index');

    Route::get('/reservas/crear', [ReservaController::class, 'create'])
        ->name('reservas.create');

    Route::post('/reservas', [ReservaController::class, 'store'])
        ->name('reservas.store');

    Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])
        ->name('reservas.show');

    Route::patch('/reservas/{reserva}/cancelar', [ReservaController::class, 'cancel'])
        ->name('reservas.cancel');
});
