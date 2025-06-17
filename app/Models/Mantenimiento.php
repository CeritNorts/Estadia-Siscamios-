<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $fillable = [
        'camion_id',
        'tipo',
        'descripcion',
        'fecha',
        'costo',
        'proveedor',
    ];

    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }
}
