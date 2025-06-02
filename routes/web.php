<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\CamionController;

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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // actualizado para usar controlador

//  Rutas de registro usando el controlador
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas de login y logout 
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard o página principal después del login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard'); // Protegido por auth

// Ruta del perfil
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/camiones', function () {
    return view('camiones');
})->name('camiones');

Route::get('/viajes', function () {
    return view('viajes');
})->name('viajes');

Route::get('/mantenimiento', function () {
    return view('mantenimiento');
})->name('mantenimiento');

Route::get('/conductores', function () {
    return view('conductores');
})->name('conductores');

// Rutas POST para el frontend (sin funcionalidad backend por ahora)
// Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');

// Rutas para el controlador de camiones
Route::resource('camiones', CamionController::class);
