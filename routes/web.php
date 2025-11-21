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

    Route::get('/admin/torres', [App\Http\Controllers\TorreController::class, 'index'])->name('torres.index');
    Route::get('/admin/torres/create', [App\Http\Controllers\TorreController::class, 'create'])->name('torres.create');
    Route::post('/admin/torres', [App\Http\Controllers\TorreController::class, 'store'])->name('torres.store');
    Route::get('/admin/torres/{torre}/edit', [App\Http\Controllers\TorreController::class, 'edit'])->name('torres.edit');
    Route::put('/admin/torres/{torre}', [App\Http\Controllers\TorreController::class, 'update'])->name('torres.update');
    Route::delete('/admin/torres/{torre}', [App\Http\Controllers\TorreController::class, 'destroy'])->name('torres.destroy');

    Route::get('/admin/apartamentos', [App\Http\Controllers\ApartamentoController::class, 'index'])->name('apartamentos.index');
    Route::get('/admin/apartamentos/create', [App\Http\Controllers\ApartamentoController::class, 'create'])->name('apartamentos.create');
    Route::post('/admin/apartamentos', [App\Http\Controllers\ApartamentoController::class, 'store'])->name('apartamentos.store');
    Route::get('/admin/apartamentos/{apartamento}/edit', [App\Http\Controllers\ApartamentoController::class, 'edit'])->name('apartamentos.edit');
    Route::put('/admin/apartamentos/{apartamento}', [App\Http\Controllers\ApartamentoController::class, 'update'])->name('apartamentos.update');
    Route::delete('/admin/apartamentos/{apartamento}', [App\Http\Controllers\ApartamentoController::class, 'destroy'])->name('apartamentos.destroy');

    Route::get('/admin/residentes', [App\Http\Controllers\ResidenteController::class, 'index'])->name('residentes.index');
    Route::get('/admin/residentes/create', [App\Http\Controllers\ResidenteController::class, 'create'])->name('residentes.create');
    Route::post('/admin/residentes', [App\Http\Controllers\ResidenteController::class, 'store'])->name('residentes.store');
    Route::get('/admin/residentes/{residente}/edit', [App\Http\Controllers\ResidenteController::class, 'edit'])->name('residentes.edit');
    Route::put('/admin/residentes/{residente}', [App\Http\Controllers\ResidenteController::class, 'update'])->name('residentes.update');
    Route::delete('/admin/residentes/{residente}', [App\Http\Controllers\ResidenteController::class, 'destroy'])->name('residentes.destroy');

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
