<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AlojamientoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:6,1');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/alojamientos', [AlojamientoController::class, 'index'])->name('alojamientos.index');
Route::get('/alojamientos/{alojamiento}', [AlojamientoController::class, 'show'])->whereNumber('alojamiento')->name('alojamientos.show');

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/alojamientos/crear', [AlojamientoController::class, 'create'])->name('alojamientos.create');
    Route::post('/alojamientos', [AlojamientoController::class, 'store'])->name('alojamientos.store');
    Route::get('/mis-alojamientos', [AlojamientoController::class, 'manage'])->name('alojamientos.manage');
    Route::get('/alojamientos/{alojamiento}/editar', [AlojamientoController::class, 'edit'])->whereNumber('alojamiento')->name('alojamientos.edit');
    Route::put('/alojamientos/{alojamiento}', [AlojamientoController::class, 'update'])->whereNumber('alojamiento')->name('alojamientos.update');
    Route::delete('/alojamientos/{alojamiento}', [AlojamientoController::class, 'destroy'])->whereNumber('alojamiento')->name('alojamientos.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/alojamientos', [AlojamientoController::class, 'adminIndex'])->name('alojamientos.index');
    Route::get('/alojamientos/{alojamiento}/editar', [AlojamientoController::class, 'edit'])->whereNumber('alojamiento')->name('alojamientos.edit');
    Route::put('/alojamientos/{alojamiento}', [AlojamientoController::class, 'update'])->whereNumber('alojamiento')->name('alojamientos.update');
    Route::delete('/alojamientos/{alojamiento}', [AlojamientoController::class, 'destroy'])->whereNumber('alojamiento')->name('alojamientos.destroy');
    Route::get('/usuarios', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/usuarios/{user}/rol', [AdminUserController::class, 'updateRole'])->whereNumber('user')->name('users.role');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/{reserva}', [ReservaController::class, 'show'])->whereNumber('reserva')->name('reservas.show');
    Route::patch('/reservas/{reserva}/cancelar', [ReservaController::class, 'cancel'])->whereNumber('reserva')->name('reservas.cancel');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/reservas/crear', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
});

Route::middleware(['auth', 'role:owner,admin'])->patch('/reservas/{reserva}/confirmar', [ReservaController::class, 'confirm'])
    ->whereNumber('reserva')->name('reservas.confirm');
