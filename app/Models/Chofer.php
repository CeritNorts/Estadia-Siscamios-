<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chofer extends Model
{
    use HasFactory;

    protected $table = 'choferes';

    protected $fillable = [
        'nombre',
        'telefono',
        'licencia',
        'tipo_licencia',
        'vencimiento_licencia',
        'estado'
    ];

    protected $casts = [
        'vencimiento_licencia' => 'date',
    ];

    // Relación: un chofer puede tener muchos viajes
    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }

    // Accessor para obtener el estado formateado
    public function getEstadoFormateadoAttribute()
    {
        return ucfirst($this->estado ?? 'activo');
    }

    // Scope para obtener solo choferes activos
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    // Scope para obtener choferes con licencias próximas a vencer
    public function scopeLicenciasPorVencer($query, $dias = 30)
    {
        return $query->whereNotNull('vencimiento_licencia')
                    ->whereBetween('vencimiento_licencia', [
                        now(),
                        now()->addDays($dias)
                    ]);
    }

    // Método para verificar si la licencia está vencida
    public function licenciaVencida()
    {
        if (!$this->vencimiento_licencia) {
            return false;
        }
        return $this->vencimiento_licencia < now();
    }

    // Método para obtener días restantes hasta el vencimiento
    public function diasHastaVencimiento()
    {
        if (!$this->vencimiento_licencia) {
            return null;
        }
        return now()->diffInDays($this->vencimiento_licencia, false);
    }
}