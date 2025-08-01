<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Camion;
use App\Models\Chofer;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function index()
    {
        // Actualizar todos los estados antes de mostrar la lista
        $viajesActualizados = Viaje::actualizarTodosLosEstados();
        
        // Si se actualizaron viajes, mostrar mensaje
        if ($viajesActualizados > 0) {
            session()->flash('success', "Se actualizaron automáticamente {$viajesActualizados} viaje(s) según sus horarios programados.");
        }
        
        $viajes = Viaje::with(['camion', 'chofer', 'cliente'])
                      ->orderBy('fecha_salida', 'desc')
                      ->get();
        
        return view('viajes', compact('viajes'));
    }

    /**
     * Muestra el formulario para crear un nuevo viaje.
     */
    public function create()
    {
        // Solo obtener camiones con estado "activo"
        $camiones = Camion::where('estado', 'activo')->get(); 
        $choferes = Chofer::all();  
        $clientes = Cliente::all(); 
        
        return view('asignarViaje', compact('camiones', 'choferes', 'clientes'));
    }

    public function store(Request $request)
    {
        // Debug: Ver qué datos llegan
        \Log::info('Datos del formulario:', $request->all());
        
        try {
            $request->validate([
                'camion_id' => 'required|exists:camiones,id',
                'chofer_id' => 'required|exists:choferes,id',
                'cliente_id' => 'required|exists:clientes,id',
                'ruta' => 'required|string',
                'fecha_salida' => 'required|date',
                'fecha_llegada' => 'required|date|after_or_equal:fecha_salida',
                'estado' => 'required|string',
            ]);

            // Validación adicional: verificar que el camión esté activo
            $camion = Camion::find($request->camion_id);
            if (!$camion || $camion->estado !== 'activo') {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'El camión seleccionado no está disponible. Solo se pueden asignar viajes a camiones activos.');
            }
            
            \Log::info('Validación pasada, creando viaje...');
            
            $viaje = Viaje::create($request->all());
            
            // Actualizar el estado automáticamente después de crear
            $viaje->actualizarEstadoAutomatico();
            
            \Log::info('Viaje creado:', $viaje->toArray());
            
            return redirect()->route('viajes.index')->with('success', 'Viaje registrado correctamente');
            
        } catch (\Exception $e) {
            \Log::error('Error creando viaje: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear el viaje: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $viaje = Viaje::with(['camion', 'chofer', 'cliente'])->find($id);
        
        if (!$viaje) {
            return redirect()->route('viajes.index')->with('error', 'Viaje no encontrado');
        }
        
        // Actualizar estado antes de mostrar
        $viaje->actualizarEstadoAutomatico();
        
        return view('viajes.show', compact('viaje'));
    }

    /**
     * Muestra el formulario para editar un viaje.
     */
    public function edit($id)
    {
        $viaje = Viaje::findOrFail($id);
        
        // Actualizar estado antes de editar
        $viaje->actualizarEstadoAutomatico();
        
        // Para edición, mostrar todos los camiones pero indicar cuáles están disponibles
        $camiones = Camion::all();
        $choferes = Chofer::all();
        $clientes = Cliente::all();
        
       return view('editarViaje', compact('viaje', 'camiones', 'choferes', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $viaje = Viaje::find($id);
        if (!$viaje) {
            return redirect()->route('viajes.index')->with('error', 'Viaje no encontrado');
        }

        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'chofer_id' => 'required|exists:choferes,id',
            'cliente_id' => 'required|exists:clientes,id',
            'ruta' => 'required|string',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after_or_equal:fecha_salida',
            'estado' => 'required|string',
        ]);

        // Validación adicional para updates: verificar estado del camión si cambió
        if ($request->camion_id != $viaje->camion_id) {
            $camion = Camion::find($request->camion_id);
            if (!$camion || $camion->estado !== 'activo') {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'El camión seleccionado no está disponible. Solo se pueden asignar viajes a camiones activos.');
            }
        }

        $viaje->update($request->all());
        
        // Actualizar estado automáticamente después de la actualización
        $viaje->actualizarEstadoAutomatico();

        return redirect()->route('viajes.index')->with('success', 'Viaje actualizado correctamente');
    }

    public function destroy($id)
    {
        $viaje = Viaje::find($id);
        if (!$viaje) {
            return redirect()->route('viajes.index')->with('error', 'Viaje no encontrado');
        }

        $viaje->delete();
        return redirect()->route('viajes.index')->with('success', 'Viaje eliminado correctamente');
    }

    /**
     * Endpoint para actualizar estados manualmente via AJAX
     */
    public function actualizarEstados()
    {
        try {
            $viajesActualizados = Viaje::actualizarTodosLosEstados();
            
            return response()->json([
                'success' => true,
                'message' => "Se actualizaron {$viajesActualizados} viaje(s)",
                'viajes_actualizados' => $viajesActualizados
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar estados: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas actualizadas para el dashboard
     */
    public function getEstadisticas()
    {
        // Actualizar estados antes de calcular estadísticas
        Viaje::actualizarTodosLosEstados();
        
        $viajes = Viaje::all();
        
        return response()->json([
            'programados' => $viajes->where('estado', 'programado')->count(),
            'transito' => $viajes->where('estado', 'transito')->count(),
            'entregados' => $viajes->where('estado', 'entregado')->count(),
            'retrasados' => $viajes->where('estado', 'retrasado')->count(),
            'total' => $viajes->count()
        ]);
    }

    /**
     * Marcar un viaje como retrasado manualmente
     */
    public function marcarRetrasado($id)
    {
        $viaje = Viaje::findOrFail($id);
        
        if ($viaje->marcarComoRetrasado()) {
            return redirect()->back()->with('success', 'Viaje marcado como retrasado');
        }
        
        return redirect()->back()->with('error', 'No se pudo marcar el viaje como retrasado');
    }

    /**
     * Obtener viajes que requieren atención
     */
    public function viajesRequierenAtencion()
    {
        $viajes = Viaje::requierenAtencion()
                      ->with(['camion', 'chofer', 'cliente'])
                      ->get();
        
        return response()->json($viajes);
    }
}