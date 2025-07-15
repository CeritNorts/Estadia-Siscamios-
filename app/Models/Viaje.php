<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Viaje extends Model
{
    protected $table = 'viajes';

    protected $fillable = [
        'camion_id',
        'chofer_id',
        'cliente_id',
        'ruta',
        'fecha_salida',
        'fecha_llegada',
        'estado'
    ];

    protected $dates = [
        'fecha_salida',
        'fecha_llegada'
    ];

    // Constantes para los estados
    const ESTADO_PROGRAMADO = 'programado';
    const ESTADO_TRANSITO = 'transito';
    const ESTADO_ENTREGADO = 'entregado';
    const ESTADO_RETRASADO = 'retrasado';
    const ESTADO_ESPERA = 'espera';

    // Array con todos los estados posibles
    public static function getEstados()
    {
        return [
            self::ESTADO_PROGRAMADO => 'Programado',
            self::ESTADO_TRANSITO => 'En Tránsito',
            self::ESTADO_ENTREGADO => 'Entregado',
            self::ESTADO_RETRASADO => 'Retrasado',
            self::ESTADO_ESPERA => 'En Espera'
        ];
    }

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

    // Scopes para filtrar por estado
    public function scopeProgramados($query)
    {
        return $query->where('estado', self::ESTADO_PROGRAMADO);
    }

    public function scopeEnTransito($query)
    {
        return $query->where('estado', self::ESTADO_TRANSITO);
    }

    public function scopeEntregados($query)
    {
        return $query->where('estado', self::ESTADO_ENTREGADO);
    }

    public function scopeRetrasados($query)
    {
        return $query->where('estado', self::ESTADO_RETRASADO);
    }

    // Método principal para actualizar el estado automáticamente
    public function actualizarEstadoAutomatico()
    {
        $ahora = Carbon::now();
        $fechaSalida = Carbon::parse($this->fecha_salida);
        $fechaLlegada = Carbon::parse($this->fecha_llegada);

        // Solo actualizar si el viaje está en estados que pueden cambiar automáticamente
        if (!in_array($this->estado, [self::ESTADO_PROGRAMADO, self::ESTADO_TRANSITO])) {
            return false;
        }

        $estadoAnterior = $this->estado;

        if ($ahora >= $fechaLlegada) {
            // Si ya pasó la hora de llegada, marcar como entregado
            $this->estado = self::ESTADO_ENTREGADO;
        } elseif ($ahora >= $fechaSalida) {
            // Si ya pasó la hora de salida pero no la de llegada, en tránsito
            $this->estado = self::ESTADO_TRANSITO;
        } else {
            // Si aún no llega la hora de salida, programado
            $this->estado = self::ESTADO_PROGRAMADO;
        }

        // Solo guardar si hubo cambio
        if ($estadoAnterior !== $this->estado) {
            $this->save();
            return true;
        }

        return false;
    }

    // Método estático para actualizar todos los viajes
    public static function actualizarTodosLosEstados()
    {
        $viajesActualizados = 0;
        
        // Obtener viajes que pueden ser actualizados automáticamente
        $viajes = self::whereIn('estado', [
            self::ESTADO_PROGRAMADO, 
            self::ESTADO_TRANSITO
        ])->get();

        foreach ($viajes as $viaje) {
            if ($viaje->actualizarEstadoAutomatico()) {
                $viajesActualizados++;
            }
        }

        return $viajesActualizados;
    }

    // Verificar si el viaje está retrasado
    public function estaRetrasado()
    {
        $ahora = Carbon::now();
        $fechaLlegada = Carbon::parse($this->fecha_llegada);
        
        return $ahora > $fechaLlegada && 
               in_array($this->estado, [self::ESTADO_PROGRAMADO, self::ESTADO_TRANSITO]);
    }

    // Marcar viaje como retrasado
    public function marcarComoRetrasado()
    {
        if ($this->estaRetrasado()) {
            $this->estado = self::ESTADO_RETRASADO;
            return $this->save();
        }
        return false;
    }

    // Obtener tiempo restante hasta la salida
    public function getTiempoHastaSalidaAttribute()
    {
        $ahora = Carbon::now();
        $fechaSalida = Carbon::parse($this->fecha_salida);
        
        if ($ahora >= $fechaSalida) {
            return null;
        }
        
        return $fechaSalida->diffForHumans();
    }

    // Obtener tiempo restante hasta la llegada
    public function getTiempoHastaLlegadaAttribute()
    {
        $ahora = Carbon::now();
        $fechaLlegada = Carbon::parse($this->fecha_llegada);
        
        if ($ahora >= $fechaLlegada) {
            return null;
        }
        
        return $fechaLlegada->diffForHumans();
    }

    // Verificar si el viaje está en curso
    public function estaEnCurso()
    {
        $ahora = Carbon::now();
        $fechaSalida = Carbon::parse($this->fecha_salida);
        $fechaLlegada = Carbon::parse($this->fecha_llegada);
        
        return $ahora >= $fechaSalida && $ahora < $fechaLlegada;
    }

    // Verificar si el viaje ya terminó
    public function yaTermino()
    {
        $ahora = Carbon::now();
        $fechaLlegada = Carbon::parse($this->fecha_llegada);
        
        return $ahora >= $fechaLlegada;
    }

    // Obtener clase CSS para el estado
    public function getEstadoCssClassAttribute()
    {
        switch ($this->estado) {
            case self::ESTADO_PROGRAMADO:
                return 'status-programado';
            case self::ESTADO_TRANSITO:
                return 'status-transito';
            case self::ESTADO_ENTREGADO:
                return 'status-entregado';
            case self::ESTADO_RETRASADO:
                return 'status-retrasado';
            case self::ESTADO_ESPERA:
                return 'status-espera';
            default:
                return 'status-unknown';
        }
    }

    // Boot del modelo para actualizar automáticamente al cargar
    protected static function boot()
    {
        parent::boot();

        // Actualizar estado automáticamente al recuperar el modelo
        static::retrieved(function ($viaje) {
            $viaje->actualizarEstadoAutomatico();
        });

        // Validar fechas antes de guardar
        static::saving(function ($viaje) {
            $fechaSalida = Carbon::parse($viaje->fecha_salida);
            $fechaLlegada = Carbon::parse($viaje->fecha_llegada);
            
            if ($fechaLlegada <= $fechaSalida) {
                throw new \InvalidArgumentException('La fecha de llegada debe ser posterior a la fecha de salida');
            }
        });
    }

    // Scope para viajes que necesitan atención (retrasados o próximos a vencer)
    public function scopeRequierenAtencion($query)
    {
        $ahora = Carbon::now();
        $proximaHora = $ahora->copy()->addHour();
        
        return $query->where(function ($q) use ($ahora, $proximaHora) {
            $q->where('estado', self::ESTADO_RETRASADO)
              ->orWhere(function ($subQ) use ($ahora, $proximaHora) {
                  $subQ->where('estado', self::ESTADO_PROGRAMADO)
                       ->whereBetween('fecha_salida', [$ahora, $proximaHora]);
              });
        });
    }
}