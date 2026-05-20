<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\VeterinarioController;
use App\Http\Controllers\Admin\ConfiguracionController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/logear', [AuthController::class, 'logear'])->name('logear');
});

Route::middleware("auth")->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rutas de Expedientes
    Route::get('/expedientes', [App\Http\Controllers\ExpedienteController::class, 'index'])->name('expedientes.index');
    Route::get('/expedientes/buscar', [App\Http\Controllers\ExpedienteController::class, 'buscar'])->name('expedientes.buscar');

    // Pacientes (mascotas)
    Route::get('/pacientes', [MascotaController::class, 'index'])->name('pacientes.index');
    Route::get('/pacientes/nuevo', [MascotaController::class, 'create'])->name('pacientes.create');
    Route::post('/pacientes', [MascotaController::class, 'store'])->name('pacientes.store');

    // Consultas
    Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
    Route::get('/consultas/nueva', [ConsultaController::class, 'create'])->name('consultas.create');
    Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
    Route::get('/consultas/{consulta}/receta', [ConsultaController::class, 'receta'])->name('consultas.receta');
    Route::post('/perfil/firma', [ConsultaController::class, 'subirFirma'])->name('perfil.firma');

    // Citas
    Route::get('/citas/nueva', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

    // Rutas del Administrador
    Route::get('/admin/home', [AuthController::class, 'adminHome'])->name('admin.home');

    // Gestión de Usuarios (CRUD)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->names([
            'index'   => 'users.index',
            'create'  => 'users.create',
            'store'   => 'users.store',
            'edit'    => 'users.edit',
            'update'  => 'users.update',
            'destroy' => 'users.destroy',
        ]);
        Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('reportes/exportar-pdf', [ReporteController::class, 'exportarPdf'])->name('reportes.exportar');
        Route::get('veterinarios', [VeterinarioController::class, 'index'])->name('veterinarios.index');
        Route::get('configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
        Route::put('configuracion', [ConfiguracionController::class, 'update'])->name('configuracion.update');
    });
});