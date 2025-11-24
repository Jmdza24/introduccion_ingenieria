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

    Route::get('/admin/residentes', [App\Http\Controllers\ResidenteController::class, 'index'])->name('admin.residentes.index');
    Route::get('/admin/residentes/create', [App\Http\Controllers\ResidenteController::class, 'create'])->name('residentes.create');
    Route::post('/admin/residentes', [App\Http\Controllers\ResidenteController::class, 'store'])->name('residentes.store');
    Route::get('/admin/residentes/{residente}/edit', [App\Http\Controllers\ResidenteController::class, 'edit'])->name('residentes.edit');
    Route::put('/admin/residentes/{residente}', [App\Http\Controllers\ResidenteController::class, 'update'])->name('residentes.update');
    Route::delete('/admin/residentes/{residente}', [App\Http\Controllers\ResidenteController::class, 'destroy'])->name('residentes.destroy');

    // Consultas para administrador

    // Historial completo
    Route::get('/admin/visitas/historial', [App\Http\Controllers\VisitaController::class, 'historialTotal'])
        ->name('visitas.historial');

    // Consultar visitas por fecha
    Route::get('/admin/visitas/consulta/fecha', [App\Http\Controllers\VisitaController::class, 'consultaFecha'])
        ->name('visitas.consulta.fecha');
    Route::post('/admin/visitas/consulta/fecha', [App\Http\Controllers\VisitaController::class, 'procesarConsultaFecha'])
        ->name('visitas.consulta.fecha.procesar');

    // Consultar visitas por apartamento
    Route::get('/admin/visitas/consulta/apartamento', [App\Http\Controllers\VisitaController::class, 'consultaApartamento'])
        ->name('visitas.consulta.apartamento');
    Route::post('/admin/visitas/consulta/apartamento', [App\Http\Controllers\VisitaController::class, 'procesarConsultaApartamento'])
        ->name('visitas.consulta.apartamento.procesar');

    // Consultar visitas por visitante
    Route::get('/admin/visitas/consulta/visitante', [App\Http\Controllers\VisitaController::class, 'consultaVisitante'])
        ->name('visitas.consulta.visitante');
    Route::post('/admin/visitas/consulta/visitante', [App\Http\Controllers\VisitaController::class, 'procesarConsultaVisitante'])
        ->name('visitas.consulta.visitante.procesar');

});


// -------------------------
// RUTAS PARA VIGILANTE
// -------------------------
Route::middleware(['auth', 'vigilante'])->group(function () {

    // Dashboard Vigilante
    Route::get('/vigilante/dashboard', function () {
        $ultimas = app(\App\Http\Controllers\VisitaController::class)->ultimasVisitas();
        return view('dashboard.vigilante', compact('ultimas'));
    })->name('vigilante.dashboard');

    // Módulo de Visitas - Vigilante

    // 1. Buscar visitante por cédula
    Route::get('/vigilante/visitas/buscar', [App\Http\Controllers\VisitaController::class, 'buscarVisitante'])
        ->name('visitas.buscar');

    // 2. Procesar búsqueda de visitante (nuevo o existente)
    Route::post('/vigilante/visitas/procesar', [App\Http\Controllers\VisitaController::class, 'procesarBusqueda'])
        ->name('visitas.procesar');

    // 3. Registrar ingreso de visitante NUEVO
    Route::post('/vigilante/visitas/ingreso/nuevo', [App\Http\Controllers\VisitaController::class, 'registrarIngresoNuevo'])
        ->name('visitas.ingreso.nuevo');

    // 4. Registrar ingreso de visitante EXISTENTE
    Route::post('/vigilante/visitas/ingreso/existente', [App\Http\Controllers\VisitaController::class, 'registrarIngresoExistente'])
        ->name('visitas.ingreso.existente');

    // 5. Registrar salida
    Route::get('/vigilante/visitas/salida/{id}', [App\Http\Controllers\VisitaController::class, 'registrarSalida'])
        ->name('visitas.salida');

    // 6. Ver lista de visitantes dentro actualmente
    Route::get('/vigilante/visitas/dentro', [App\Http\Controllers\VisitaController::class, 'visitantesDentro'])
        ->name('visitas.dentro');

    // 7. Ver visitas del día
    Route::get('/vigilante/visitas/hoy', [App\Http\Controllers\VisitaController::class, 'visitasHoy'])
        ->name('visitas.hoy');

    // 8. ver residentes
    Route::get('/residentes', [App\Http\Controllers\ResidenteController::class, 'index'])->name('vigilante.residentes.index');
});
