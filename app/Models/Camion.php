<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    protected $table = 'camiones';

    protected $fillable = [
        'placa',
        'modelo',
        'anio',
        'capacidad_carga',
        'estado',
    ];

    // Constantes para los estados
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_MANTENIMIENTO = 'mantenimiento';
    const ESTADO_INACTIVO = 'inactivo';

    // Array con todos los estados posibles
    public static function getEstados()
    {
        return [
            self::ESTADO_ACTIVO => 'Activo',
            self::ESTADO_MANTENIMIENTO => 'En Mantenimiento',
            self::ESTADO_INACTIVO => 'Inactivo'
        ];
    }

    // Scope para obtener solo camiones activos
    public function scopeActivos($query)
    {
        return $query->where('estado', self::ESTADO_ACTIVO);
    }

    // Scope para obtener camiones disponibles (activos)
    public function scopeDisponibles($query)
    {
        return $query->where('estado', self::ESTADO_ACTIVO);
    }

    // Método para verificar si el camión está disponible para viajes
    public function estaDisponible()
    {
        return $this->estado === self::ESTADO_ACTIVO;
    }

    // Método para verificar si el camión está activo
    public function estaActivo()
    {
        return $this->estado === self::ESTADO_ACTIVO;
    }

    // Obtener el nombre del estado formateado
    public function getEstadoFormateadoAttribute()
    {
        $estados = self::getEstados();
        return $estados[$this->estado] ?? $this->estado;
    }

    // Obtener clase CSS para el estado
    public function getEstadoCssClassAttribute()
    {
        switch ($this->estado) {
            case self::ESTADO_ACTIVO:
                return 'status-activo';
            case self::ESTADO_MANTENIMIENTO:
                return 'status-mantenimiento';
            case self::ESTADO_INACTIVO:
                return 'status-inactivo';
            default:
                return 'status-unknown';
        }
    }

    // Relaciones existentes
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    // Relación con viajes (agregar si tienes el modelo Viaje)
    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}