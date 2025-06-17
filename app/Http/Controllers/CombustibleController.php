<?php

namespace App\Http\Controllers;

use App\Models\Combustible;
use App\Models\Viaje;
use Illuminate\Http\Request;

class CombustibleController extends Controller
{
    /**
     * Muestra todos los registros de combustible.
     */
    public function index()
    {
        $combustibles = Combustible::with('viaje')->get();
        return view('combustible.index', compact('combustibles'));
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
}
