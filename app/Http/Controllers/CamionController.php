<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use Illuminate\Http\Request;

class CamionController extends Controller
{
    /**
     * Muestra todos los camiones.
     */
    public function index()
    {
        $camiones = Camion::all();
        return response()->json($camiones);
    }

    /**
     * Muestra el formulario para crear un nuevo camión.
     */
    public function create()
    {
        // Solo necesario si usas vistas Blade.
    }

    /**
     * Guarda un nuevo camión.
     */
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|unique:camiones',
            'modelo' => 'required|string',
            'anio' => 'required|integer|min:2000|max:' . date('Y'),
            'capacidad_carga' => 'required|numeric|min:0',
            'estado' => 'required|string',
        ]);

        $camion = Camion::create($request->all());

        return response()->json([
            'message' => 'Camión registrado correctamente',
            'data' => $camion
        ], 201);
    }

    /**
     * Muestra un camión específico.
     */
    public function show($id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return response()->json(['message' => 'Camión no encontrado'], 404);
        }

        return response()->json($camion);
    }

    /**
     * Muestra el formulario para editar un camión.
     */
    public function edit($id)
    {
    
    }

    /**
     * Actualiza un camión existente.
     */
    public function update(Request $request, $id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return response()->json(['message' => 'Camión no encontrado'], 404);
        }

        $request->validate([
            'placa' => 'sometimes|required|string|unique:camiones,placa,' . $id,
            'modelo' => 'sometimes|required|string',
            'anio' => 'sometimes|required|integer|min:2000|max:' . date('Y'),
            'capacidad_carga' => 'sometimes|required|numeric|min:0',
            'estado' => 'sometimes|required|string',
        ]);

        $camion->update($request->all());

        return response()->json([
            'message' => 'Camión actualizado correctamente',
            'data' => $camion
        ]);
    }

    /**
     * Elimina un camión.
     */
    public function destroy($id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return response()->json(['message' => 'Camión no encontrado'], 404);
        }

        $camion->delete();

        return response()->json(['message' => 'Camión eliminado correctamente']);
    }
}
