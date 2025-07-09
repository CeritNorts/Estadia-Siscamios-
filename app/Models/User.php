<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atributos asignados.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // agregado para asignar roles al crear usuarios
    ];

    /**
     * Consulta de atributos.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos casteados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relación: un usuario pertenece a un rol.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Indica si el usuario puede acceder al panel de Filament.
     *
     * @return bool
     */
    public function canAccessFilament(): bool
    {
        return true;
    }

    /**
     * Verificar si el usuario tiene un rol específico.
     *
     * @param string $roleName
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }
}
