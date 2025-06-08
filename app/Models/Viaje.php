<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $fillable = [
        'camion_id',
        'chofer_id',
        'cliente_id',
        'ruta',
        'fecha_salida',
        'fecha_llegada',
        'estado',
    ];

    // Relaciones
    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
