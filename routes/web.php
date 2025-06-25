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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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


// Rutas para el controlador de camiones 
Route::resource('camiones', CamionController::class);

// Rutas para el controlador de viajes
Route::resource('viajes', ViajeController::class);
Route::get('/asignarViaje', [ViajeController::class, 'create'])->name('asignarViaje');

// Rutas para el controlador de combustible
Route::resource('combustibles', CombustibleController::class);

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