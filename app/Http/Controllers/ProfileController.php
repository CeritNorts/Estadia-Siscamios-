<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Mostrar el perfil del usuario.
     */
    public function show()
    {
        return view('profile');
    }

    /**
     * Actualizar la información del perfil.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Si es cambio de contraseña
        if ($request->has('action') && $request->action === 'change_password') {
            return $this->updatePassword($request, $user);
        }

        // Si es actualización de información personal
        return $this->updatePersonalInfo($request, $user);
    }

    /**
     * Actualizar información personal.
     */
    private function updatePersonalInfo(Request $request, $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Información personal actualizada correctamente.');
    }

    /**
     * Actualizar contraseña.
     */
    private function updatePassword(Request $request, $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verificar contraseña actual
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar contraseña
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
    }
}