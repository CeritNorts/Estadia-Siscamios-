<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'contacto',
        'contrato',
        'tipo',   
        'estado', 
    ];

    // Relación: un cliente puede tener muchos viajes
    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }

    // Accessor para obtener el estado formateado
    public function getEstadoFormateadoAttribute()
    {
        return ucfirst($this->estado); 
    }

    // Accessor para simular tipo de cliente
    public function getTipoFormateadoAttribute()
    {
        return ucfirst($this->tipo); 
    }

    // Scope para obtener todos los clientes 
    public function scopeActivos($query)
    {
        // Si tienes una columna 'estado' en tu tabla 'clientes'
        return $query->where('estado', 'activo'); 
    }

    // Método para verificar si está activo 
    public function estaActivo()
    {
        // Si tienes una columna 'estado' en tu tabla 'clientes'
        return $this->estado === 'activo'; 
    }

    // Método para obtener estadísticas del cliente
    public function getEstadisticas()
    {
        return [
            'total_viajes' => $this->viajes()->count(),
            'viajes_mes_actual' => $this->viajes()
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'ultimo_viaje' => $this->viajes()->latest()->first(),
        ];
    }
}
