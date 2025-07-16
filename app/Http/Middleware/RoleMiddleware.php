<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Carga el usuario autenticado con su relación de rol para asegurar que esté disponible
        $user = Auth::user()->load('role');

        // --- DEPURACIÓN: ESTAS LÍNEAS DEBEN ESTAR COMENTADAS EN PRODUCCIÓN ---
        // dd([
        //     'middleware_user_id' => $user->id,
        //     'middleware_user_name' => $user->name,
        //     'middleware_user_role_object' => $user->role,
        //     'middleware_user_role_name' => $user->role ? $user->role->nombre : 'NO_ROLE_LOADED',
        //     'roles_required_by_route' => $roles,
        //     'has_role_check_result' => $user->hasRole($roles[0] ?? 'N/A'),
        // ]);
        // --- FIN DE DEPURACIÓN ---

        if (empty($roles)) {
            return $next($request);
        }

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request); // Si el usuario tiene el rol, permite el acceso
            }
        }

        // Si el bucle termina y el usuario no tiene ninguno de los roles requeridos
        return abort(403, 'Acceso no autorizado. No tienes el rol requerido para esta acción.');
    }
}