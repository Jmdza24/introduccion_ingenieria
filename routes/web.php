<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Cuando entren a "/" → Redirige al Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// -------------------------
// RUTAS PARA ADMINISTRADOR
// -------------------------
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

});


// -------------------------
// RUTAS PARA VIGILANTE
// -------------------------
Route::middleware(['auth', 'vigilante'])->group(function () {

    // Dashboard Vigilante
    Route::get('/vigilante/dashboard', function () {
        return view('dashboard.vigilante');
    })->name('vigilante.dashboard');

});
