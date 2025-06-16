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
    ];

    // Relación: un chofer puede tener muchos viajes
    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
