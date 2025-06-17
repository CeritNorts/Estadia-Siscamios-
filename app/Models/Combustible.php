<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    use HasFactory;

    protected $table = 'combustibles';

    protected $fillable = [
        'viaje_id',
        'cantidad_litros',
        'costo',
        'fecha',
    ];

    /**
     * Relación: un registro de combustible pertenece a un viaje.
     */
    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }
}
