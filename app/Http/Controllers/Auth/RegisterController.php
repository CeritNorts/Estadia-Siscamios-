<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Obtener el ID del rol "Chofer"
        $defaultRole = Role::where('nombre', 'Chofer')->first();

        if (!$defaultRole) {
            // Esto debería capturar si el rol 'Chofer' no existe en la DB
            return redirect()->back()->withErrors(['error' => 'No se pudo asignar un rol por defecto. El rol "Chofer" no fue encontrado en la base de datos. Por favor, contacta al administrador.'])->withInput();
        }

        // Crear usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $defaultRole->id, 
            'estado' => 'activo', 
        ]);

        return redirect()->route('login')->with('success', '¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.');
    }
}