<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Camion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MantenimientoController extends Controller
{
    // Mostrar lista de mantenimientos (para el resource route)
    public function index()
    {
        $mantenimientos = Mantenimiento::with('camion')->orderBy('fecha', 'desc')->paginate(10);
        return view('mantenimiento', compact('mantenimientos'));
    }

   public function dashboard()
{
    try {
        $mantenimientos = Mantenimiento::with('camion')->orderBy('fecha', 'desc')->get();
        $camiones = Camion::all();
        
        // Estadísticas básicas
        $estadisticas = [
            'programados' => $mantenimientos->where('estado', 'programado')->count(),
            'en_proceso' => $mantenimientos->where('estado', 'en_proceso')->count(),
            'completados' => $mantenimientos->where('estado', 'completado')->count(),
            'urgentes' => $mantenimientos->where('estado', 'urgente')->count(),
            'costo_total' => $mantenimientos->where('estado', 'completado')->sum('costo') ?? 0
        ];
        
        return view('mantenimiento', compact('mantenimientos', 'estadisticas', 'camiones'));
        
    } catch (\Exception $e) {
        \Log::error('Error en dashboard: ' . $e->getMessage());
        
        // Variables por defecto en caso de error
        $mantenimientos = collect();
        $camiones = collect();
        $estadisticas = [
            'programados' => 0,
            'en_proceso' => 0,
            'completados' => 0,
            'urgentes' => 0,
            'costo_total' => 0
        ];
        
        return view('mantenimiento', compact('mantenimientos', 'estadisticas', 'camiones'));
    }
}

// Método para calcular estadísticas
private function calcularEstadisticas()
{
    $hoy = \Carbon\Carbon::now();
    $inicioMes = \Carbon\Carbon::now()->startOfMonth();
    
    return [
        'programados' => Mantenimiento::where('estado', 'programado')
            ->whereBetween('fecha', [$hoy, $hoy->copy()->addDays(15)])
            ->count(),
        'en_proceso' => Mantenimiento::where('estado', 'en_proceso')->count(),
        'completados' => Mantenimiento::where('estado', 'completado')
            ->whereBetween('fecha', [$inicioMes, $hoy])
            ->count(),
        'urgentes' => Mantenimiento::where('estado', 'urgente')->count(),
        'costo_total' => Mantenimiento::where('estado', 'completado')
            ->whereBetween('fecha', [$inicioMes, $hoy])
            ->sum('costo') ?? 0
    ];
}

    // Mostrar formulario para crear un nuevo mantenimiento
    public function create()
{
    $camiones = Camion::all();
    return view('registrarMantenimiento', compact('camiones'));
}

    // Guardar un nuevo mantenimiento
    public function store(Request $request)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'costo' => 'nullable|numeric|min:0',
            'proveedor' => 'nullable|string|max:255',
            'estado' => 'required|in:programado,en_proceso,completado,urgente',
            'kilometraje' => 'nullable|integer|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string'
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimiento')->with('success', 'Mantenimiento registrado correctamente.');
    }

    // Mostrar un mantenimiento específico
    public function show(Mantenimiento $mantenimiento)
    {
        $mantenimiento->load('camion');
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    // Mostrar formulario para editar mantenimiento
    public function edit(Mantenimiento $mantenimiento)
    {
        $camiones = Camion::all();
        return view('mantenimientos.edit', compact('mantenimiento', 'camiones'));
    }

    // Actualizar mantenimiento
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'costo' => 'nullable|numeric|min:0',
            'proveedor' => 'nullable|string|max:255',
            'estado' => 'required|in:programado,en_proceso,completado,urgente',
            'kilometraje' => 'nullable|integer|min:0',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'observaciones' => 'nullable|string'
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('mantenimiento')->with('success', 'Mantenimiento actualizado correctamente.');
    }

    // Eliminar mantenimiento
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimiento')->with('success', 'Mantenimiento eliminado correctamente.');
    }

    // API para búsqueda AJAX
    public function search(Request $request)
    {
        $query = $request->get('q');
        $tipo = $request->get('tipo');
        
        $mantenimientos = Mantenimiento::with('camion')
            ->when($query, function($q) use ($query) {
                return $q->where('descripcion', 'like', "%{$query}%")
                        ->orWhereHas('camion', function($camionQuery) use ($query) {
                            $camionQuery->where('numero_interno', 'like', "%{$query}%");
                        });
            })
            ->when($tipo, function($q) use ($tipo) {
                return $q->where('tipo', $tipo);
            })
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json($mantenimientos);
    }
}