<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Importa el modelo User
use App\Models\Role; // Importa el modelo Role
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Para la validación unique con ignorar

class UserController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los usuarios con su rol cargado (relación eager loading)
        $users = User::with('role')->orderBy('name')->paginate(10); // Pagina para mejor rendimiento

         return view('admin.users.gestion-de-usuarios', compact('users'));
    }

    /**
     * Muestra el formulario para editar un usuario específico.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        // Obtiene todos los roles disponibles para el select
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza los datos de un usuario en la base de datos, incluyendo su rol.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            // Valida que el email sea único, excepto para el usuario actual
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role_id' => 'required|exists:roles,id', // Asegura que el role_id exista en la tabla 'roles'
        ]);

        // Actualiza los datos del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        // Redirige de vuelta a la lista de usuarios con un mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Opcional: Puedes agregar métodos para crear (store) y eliminar (destroy) usuarios aquí.
}