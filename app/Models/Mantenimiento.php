<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';
    
    protected $fillable = [
        'camion_id',
        'tipo',
        'descripcion',
        'fecha',
        'costo',
        'proveedor',
        'estado',
        'kilometraje',
        'fecha_inicio',
        'fecha_fin',
        'observaciones'
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'costo' => 'decimal:2'
    ];

    // Relación con Camión
    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    // Accessor para formatear fecha
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha ? $this->fecha->format('d/m/Y') : '';
    }

    // Accessor para formatear costo
    public function getCostoFormateadoAttribute()
    {
        return $this->costo ? '$' . number_format($this->costo, 2) : '$0.00';
    }

    // Scope para mantenimientos por estado
    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    // Scope para mantenimientos del mes actual
    public function scopeDelMesActual($query)
    {
        return $query->whereMonth('fecha', Carbon::now()->month)
                    ->whereYear('fecha', Carbon::now()->year);
    }

    // Scope para mantenimientos urgentes
    public function scopeUrgentes($query)
    {
        return $query->where('estado', 'urgente')
                    ->orWhere(function($q) {
                        $q->where('estado', 'programado')
                          ->where('fecha', '<=', Carbon::now()->addDays(3));
                    });
    }
}