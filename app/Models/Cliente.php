<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

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
}
