<?php

namespace App\Http\Controllers;

use App\Models\Combustible;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CombustibleController extends Controller
{
    /**
     * Muestra todos los registros de combustible.
     */
    public function index(Request $request)
    {
        // Obtener filtros
        $viajeId = $request->get('viaje_id');
        $fechaDesde = $request->get('fecha_desde', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $fechaHasta = $request->get('fecha_hasta', Carbon::now()->format('Y-m-d'));

        // Query base
        $query = Combustible::with('viaje');

        // Aplicar filtros
        if ($viajeId) {
            $query->where('viaje_id', $viajeId);
        }

        if ($fechaDesde) {
            $query->whereDate('fecha', '>=', $fechaDesde);
        }

        if ($fechaHasta) {
            $query->whereDate('fecha', '<=', $fechaHasta);
        }

        // Obtener registros paginados
        $registrosCombustible = $query->orderBy('fecha', 'desc')->paginate(10);

        // Calcular métricas del mes actual
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();

        $totalLitrosMes = Combustible::whereBetween('fecha', [$inicioMes, $finMes])
            ->sum('cantidad_litros');

        $costoTotalMes = Combustible::whereBetween('fecha', [$inicioMes, $finMes])
            ->sum('costo');

        $totalRegistros = Combustible::whereBetween('fecha', [$inicioMes, $finMes])->count();
        $eficienciaPromedio = $totalRegistros > 0 ? round(($totalLitrosMes / $totalRegistros) * 0.15, 1) : 0;

        // Viajes disponibles para filtros y formulario
        $viajes = Viaje::all();

        $mejoresEficiencias = collect([
            (object) ['viaje' => (object) ['id' => 1], 'eficiencia_promedio' => 8.5],
            (object) ['viaje' => (object) ['id' => 2], 'eficiencia_promedio' => 8.2],
            (object) ['viaje' => (object) ['id' => 3], 'eficiencia_promedio' => 7.8],
        ]);
        
        $alertas = collect([
            (object) ['tipo' => 'warning', 'titulo' => 'Eficiencia Baja', 'descripcion' => 'Algunos viajes tienen eficiencia por debajo del promedio'],
            (object) ['tipo' => 'danger', 'titulo' => 'Costo Elevado', 'descripcion' => 'Costos de combustible han aumentado 3% este mes'],
        ]);

        return view('combustible', compact(
            'registrosCombustible',
            'viajes',
            'totalLitrosMes',
            'costoTotalMes',
            'eficienciaPromedio',
            'mejoresEficiencias',
            'alertas'
        ));
    }

    /**
     * Muestra el formulario para crear un nuevo registro de combustible.
     */
    public function create()
    {
        $viajes = Viaje::all();
        return view('combustible.create', compact('viajes'));
    }

    /**
     * Guarda un nuevo registro de combustible.
     */
    public function store(Request $request)
    {
        $request->validate([
            'viaje_id' => 'required|exists:viajes,id',
            'cantidad_litros' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'fecha' => 'required|date',
        ]);

        $combustible = Combustible::create($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Registro de combustible guardado correctamente'
            ]);
        }

        return redirect()->route('combustibles.index')->with('success', 'Registro de combustible guardado correctamente');
    }

    /**
     * Muestra un solo registro.
     */
    public function show($id)
    {
        $combustible = Combustible::with('viaje')->findOrFail($id);
        return view('combustible.show', compact('combustible'));
    }

    /**
     * Muestra el formulario para editar un registro existente.
     */
    public function edit($id)
    {
        $combustible = Combustible::findOrFail($id);
        $viajes = Viaje::all();
        return view('combustible.edit', compact('combustible', 'viajes'));
    }

    /**
     * Actualiza un registro existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'viaje_id' => 'required|exists:viajes,id',
            'cantidad_litros' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'fecha' => 'required|date',
        ]);

        $combustible = Combustible::findOrFail($id);
        $combustible->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Registro de combustible actualizado correctamente'
            ]);
        }

        return redirect()->route('combustibles.index')->with('success', 'Registro de combustible actualizado correctamente');
    }

    /**
     * Elimina un registro.
     */
    public function destroy($id)
    {
        $combustible = Combustible::findOrFail($id);
        $combustible->delete();

        return redirect()->route('combustibles.index')->with('success', 'Registro de combustible eliminado');
    }

    /**
     * Exporta reporte de combustible.
     */
    public function export()
    {
        // Implementar exportación (Excel, PDF, etc.)
        return response()->json(['message' => 'Exportación en desarrollo']);
    }

    /**
     * API para obtener datos de viaje
     */
    public function getViajeData($id)
    {
        $viaje = Viaje::find($id);
        
        if ($viaje) {
            return response()->json([
                'success' => true,
                'viaje' => $viaje
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Viaje no encontrado'
        ]);
    }
}