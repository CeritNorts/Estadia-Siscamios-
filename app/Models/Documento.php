<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'camion_id',
        'tipo',
        'url',
        'vencimiento',
    ];

    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }
}
