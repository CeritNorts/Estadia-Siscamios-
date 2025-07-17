<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\CombustibleController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;

// Ruta principal - redirige al login
Route::get('/', function () {
    return redirect('/login');
});

// Rutas de autenticación (login y registro)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro usando el controlador
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas protegidas por autenticación con prevencion de cache tras logout
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas del perfil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Combustibles
    Route::get('/combustible', [CombustibleController::class, 'index'])->name('combustible');
    Route::resource('combustibles', CombustibleController::class);
    Route::get('/combustibles/export', [CombustibleController::class, 'export'])->name('combustibles.export');
    Route::get('/api/viajes/{id}/data', [CombustibleController::class, 'getViajeData']);

    // Camiones
    Route::resource('camiones', CamionController::class);

    // Viajes
    Route::resource('viajes', ViajeController::class);
    Route::get('/asignarViaje', [ViajeController::class, 'create'])->name('asignarViaje');
    Route::post('/viajes/actualizar-estados', [ViajeController::class, 'actualizarEstados'])->name('viajes.actualizar-estados');
    Route::get('/viajes/estadisticas', [ViajeController::class, 'getEstadisticas'])->name('viajes.estadisticas');
    Route::post('/viajes/{id}/marcar-retrasado', [ViajeController::class, 'marcarRetrasado'])->name('viajes.marcar-retrasado');
    Route::get('/viajes/requieren-atencion', [ViajeController::class, 'viajesRequierenAtencion'])->name('viajes.requieren-atencion');

    // Documentos
    Route::resource('documentos', DocumentoController::class);

    // Clientes
    Route::resource('clientes', ClienteController::class);
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/registrarCliente', [ClienteController::class, 'create'])->name('clientes.create');

    // Mantenimientos
    Route::get('/mantenimiento', [MantenimientoController::class, 'dashboard'])->name('mantenimiento');
    Route::get('/registrarMantenimiento', [MantenimientoController::class, 'create'])->name('registrarMantenimiento');
    Route::get('/mantenimiento/search', [MantenimientoController::class, 'search'])->name('mantenimiento.search');
    Route::resource('mantenimientos', MantenimientoController::class);

    // Choferes
    Route::resource('choferes', ChoferController::class);
    Route::get('/conductores', [ChoferController::class, 'index'])->name('conductores.index');
    Route::get('/registrarConductor', [ChoferController::class, 'create'])->name('conductores.create');

    // Administración de usuarios
    Route::middleware(['role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Paneles por rol
    Route::middleware(['role:Administrador'])->group(function () {
        Route::get('/admin/panel', function () {
            return "Bienvenido al panel de Administrador";
        })->name('admin.panel');
    });

    Route::middleware(['role:Supervisor'])->group(function () {
        Route::get('/supervisor/reportes', function () {
            return "Bienvenido a los reportes de Supervisor";
        })->name('supervisor.reportes');
    });

    Route::middleware(['role:Chofer'])->group(function () {
        Route::get('/chofer/viajes', function () {
            return "Bienvenido a tus viajes, Chofer";
        })->name('chofer.viajes');
    });

    Route::middleware(['role:Administrador,Supervisor'])->group(function () {
        Route::get('/gestion/modulos', function () {
            return "Gestión de módulos (Admin/Supervisor)";
        })->name('gestion.modulos');
    });
});
