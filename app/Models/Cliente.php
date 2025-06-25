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
    ];

    // Relación: un cliente puede tener muchos viajes
    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }

    // Accessor para obtener el estado formateado (simulado como activo por defecto)
    public function getEstadoFormateadoAttribute()
    {
        return 'Activo'; // Como no tienes campo estado, lo simulamos
    }

    // Accessor para simular tipo de cliente
    public function getTipoFormateadoAttribute()
    {
        return 'Empresa'; // Como no tienes campo tipo, lo simulamos
    }

    // Scope para obtener todos los clientes (simulando activos)
    public function scopeActivos($query)
    {
        return $query; // Devuelve todos ya que no hay campo estado
    }

    // Método para verificar si está activo (simulado)
    public function estaActivo()
    {
        return true; // Simula que todos están activos
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