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
use App\Http\Controllers\ProfileController; // ¡Nuevo controlador para el perfil!


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


// Rutas protegidas por autenticación (middleware 'auth')
Route::middleware(['auth'])->group(function () {
    // Dashboard o página principal después del login
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ----------------------------------------------------------------------
    // Rutas del Perfil de Usuario (ACTUALIZADAS)
    // ----------------------------------------------------------------------
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // ----------------------------------------------------------------------

    // Ruta principal del combustible
    Route::get('/combustible', [CombustibleController::class, 'index'])->name('combustible');

    // Rutas para el controlador de combustible
    Route::resource('combustibles', CombustibleController::class);

    // Ruta adicional para exportar reportes
    Route::get('/combustibles/export', [CombustibleController::class, 'export'])->name('combustibles.export');

    // API para obtener datos de viaje
    Route::get('/api/viajes/{id}/data', [CombustibleController::class, 'getViajeData']);

    // Rutas para el controlador de camiones
    Route::resource('camiones', CamionController::class);

    // Rutas para el controlador de viajes
    Route::resource('viajes', ViajeController::class);
    Route::get('/asignarViaje', [ViajeController::class, 'create'])->name('asignarViaje');

    // Rutas para el controlador de documentos
    Route::resource('documentos', DocumentoController::class);

    // Rutas para el controlador de clientes
    Route::resource('clientes', ClienteController::class);

    // Rutas específicas para conectar con tus vistas de clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/registrarCliente', [ClienteController::class, 'create'])->name('clientes.create');

    // Mantenimiento routes
    Route::get('/mantenimiento', [MantenimientoController::class, 'dashboard'])->name('mantenimiento');
    Route::get('/registrarMantenimiento', [MantenimientoController::class, 'create'])->name('registrarMantenimiento');
    Route::get('/mantenimiento/search', [MantenimientoController::class, 'search'])->name('mantenimiento.search');

    // Resource routes para mantenimientos
    Route::resource('mantenimientos', MantenimientoController::class);

    // Rutas para el controlador de choferes
    Route::resource('choferes', ChoferController::class);

    // Ruta para mostrar la vista de conductores conectada al controlador
    Route::get('/conductores', [ChoferController::class, 'index'])->name('conductores.index');

    // Ruta para mostrar el formulario de registro conectada al controlador
    Route::get('/registrarConductor', [ChoferController::class, 'create'])->name('conductores.create');

    // Rutas para actualización automática de viajes
    Route::post('/viajes/actualizar-estados', [ViajeController::class, 'actualizarEstados'])->name('viajes.actualizar-estados');
    Route::get('/viajes/estadisticas', [ViajeController::class, 'getEstadisticas'])->name('viajes.estadisticas');
    Route::post('/viajes/{id}/marcar-retrasado', [ViajeController::class, 'marcarRetrasado'])->name('viajes.marcar-retrasado');
    Route::get('/viajes/requieren-atencion', [ViajeController::class, 'viajesRequierenAtencion'])->name('viajes.requieren-atencion');


    // ----------------------------------------------------------------------
    // Rutas de Administración de Usuarios (NUEVAS)
    // Protegidas por el middleware 'role:Administrador'
    Route::middleware(['role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
        // Ruta para listar todos los usuarios
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        // Ruta para mostrar el formulario de edición de un usuario
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Ruta para procesar la actualización de un usuario (usando PUT para RESTful)
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        // Ruta para crear nuevos usuarios (si la necesitas)
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        // Ruta para eliminar usuarios (si la necesitas)
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    // ----------------------------------------------------------------------


    // Ejemplos de otras rutas protegidas por roles específicos (si las necesitas)
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