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
        $viajes = Viaje::with(['camion', 'chofer', 'cliente'])->get();
        return view('viajes', compact('viajes'));
    }

    /**
     * Muestra el formulario para crear un nuevo viaje.
     */
    public function create()
    {
        $camiones = Camion::all(); // Obtener todos los camiones
        $choferes = Chofer::all();  // Obtener todos los choferes
        $clientes = Cliente::all(); // Obtener todos los clientes
        
        return view('asignarViaje', compact('camiones', 'choferes', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'chofer_id' => 'required|exists:choferes,id',
            'cliente_id' => 'required|exists:clientes,id',
            'ruta' => 'required|string',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after_or_equal:fecha_salida',
            'estado' => 'required|string',
        ]);

        $viaje = Viaje::create($request->all());

        return response()->json(['message' => 'Viaje registrado', 'data' => $viaje], 201);
    }

    public function show($id)
    {
        $viaje = Viaje::with(['camion', 'chofer', 'cliente'])->find($id);
        return $viaje
            ? response()->json($viaje)
            : response()->json(['message' => 'Viaje no encontrado'], 404);
    }

    /**
     * Muestra el formulario para editar un viaje.
     */
    public function edit($id)
    {
        $viaje = Viaje::findOrFail($id);
        $camiones = Camion::all();
        $choferes = Chofer::all();
        $clientes = Cliente::all();
        
        return view('viajes.edit', compact('viaje', 'camiones', 'choferes', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $viaje = Viaje::find($id);
        if (!$viaje) {
            return response()->json(['message' => 'Viaje no encontrado'], 404);
        }

        $request->validate([
            'camion_id' => 'sometimes|exists:camiones,id',
            'chofer_id' => 'sometimes|exists:choferes,id',
            'cliente_id' => 'sometimes|exists:clientes,id',
            'ruta' => 'sometimes|string',
            'fecha_salida' => 'sometimes|date',
            'fecha_llegada' => 'sometimes|date',
            'estado' => 'sometimes|string',
        ]);

        $viaje->update($request->all());

        return response()->json(['message' => 'Viaje actualizado', 'data' => $viaje]);
    }

    public function destroy($id)
    {
        $viaje = Viaje::find($id);
        if (!$viaje) {
            return response()->json(['message' => 'Viaje no encontrado'], 404);
        }

        $viaje->delete();
        return response()->json(['message' => 'Viaje eliminado']);
    }
}