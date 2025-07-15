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


// Ruta principal - redirige al login
Route::get('/', function () {
    return redirect('/login');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

//  Rutas de registro usando el controlador
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas de login y logout 
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard o página principal después del login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Ruta del perfil
Route::get('/profile', function () {
    return view('profile');
})->name('profile.edit');

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

// Rutas para el controlador de combustible
// Route::resource('combustibles', CombustibleController::class);

// Rutas para el controlador de documentos
Route::resource('documentos', DocumentoController::class);


// Rutas para el controlador de clientes
Route::resource('clientes', ClienteController::class);

// Rutas específicas para conectar con tus vistas
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


// Rutas POST para el frontend (sin funcionalidad backend por ahora)
// Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');

// Rutas para actualización automática de viajes
Route::post('/viajes/actualizar-estados', [ViajeController::class, 'actualizarEstados'])->name('viajes.actualizar-estados');
Route::get('/viajes/estadisticas', [ViajeController::class, 'getEstadisticas'])->name('viajes.estadisticas');
Route::post('/viajes/{id}/marcar-retrasado', [ViajeController::class, 'marcarRetrasado'])->name('viajes.marcar-retrasado');
Route::get('/viajes/requieren-atencion', [ViajeController::class, 'viajesRequierenAtencion'])->name('viajes.requieren-atencion');