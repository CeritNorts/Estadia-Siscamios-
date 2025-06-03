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
        return view('camiones', compact('camiones'));
    }

    /**
     * Muestra el formulario para crear un nuevo camión.
     */
    public function create()
    {
        return view('registroCamiones');
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

        // Redirigir a la lista con mensaje de éxito
        return redirect()->route('camiones.index')
                         ->with('success', 'Camión registrado correctamente');
    }

    /**
     * Muestra un camión específico.
     */
    public function show($id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return redirect()->route('camiones.index')->with('error', 'Camión no encontrado');
        }

        return view('mostrarCamion', compact('camion')); 
    }

    /**
     * Muestra el formulario para editar un camión.
     */
    public function edit($id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return redirect()->route('camiones.index')->with('error', 'Camión no encontrado');
        }

        return view('editarCamion', compact('camion'));
    }

    /**
     * Actualiza un camión existente.
     */
    public function update(Request $request, $id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return redirect()->route('camiones.index')->with('error', 'Camión no encontrado');
        }

        $request->validate([
            'placa' => 'sometimes|required|string|unique:camiones,placa,' . $id,
            'modelo' => 'sometimes|required|string',
            'anio' => 'sometimes|required|integer|min:2000|max:' . date('Y'),
            'capacidad_carga' => 'sometimes|required|numeric|min:0',
            'estado' => 'sometimes|required|string',
        ]);

        $camion->update($request->all());

        return redirect()->route('camiones.index')
                         ->with('success', 'Camión actualizado correctamente');
    }

    /**
     * Elimina un camión.
     */
    public function destroy($id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return redirect()->route('camiones.index')->with('error', 'Camión no encontrado');
        }

        $camion->delete();

        return redirect()->route('camiones.index')
                         ->with('success', 'Camión eliminado correctamente');
    }
}
