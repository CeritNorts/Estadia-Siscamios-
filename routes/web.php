<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\CombustibleController;

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
})->name('profile');


// Rutas para el controlador de camiones 
Route::resource('camiones', CamionController::class);

// Rutas para el controlador de viajes
Route::resource('viajes', ViajeController::class);

// Rutas para el controlador de combustible
Route::resource('combustibles', CombustibleController::class);


Route::get('/asignarViaje', function () {
    return view('asignarViaje');
})->name('asignarViaje');

Route::get('/mantenimiento', function () {
    return view('mantenimiento');
})->name('mantenimiento');

Route::get('/registrarMantenimiento', function () {
    return view('registrarMantenimiento');
})->name('registrarMantenimiento');

Route::get('/conductores', function () {
    return view('conductores');
})->name('conductores');

Route::get('/registrarConductor', function () {
    return view('registrarConductor');
})->name('registrarConductor');

// Rutas POST para el frontend (sin funcionalidad backend por ahora)
// Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');