<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

//  Rutas de registro usando el controlador
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Estas rutas las agregarás cuando tengas el backend
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard o página principal después del login
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Ruta del perfil
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// Rutas POST para el frontend (sin funcionalidad backend por ahora)
// Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');