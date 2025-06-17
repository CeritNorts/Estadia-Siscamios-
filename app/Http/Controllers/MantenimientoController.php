<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Camion;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    // Mostrar lista de mantenimientos
    public function index()
    {
        $mantenimientos = Mantenimiento::with('camion')->paginate(10);
        return view('mantenimientos', compact('mantenimientos'));
    }

    // Mostrar formulario para crear un nuevo mantenimiento
    public function create()
    {
        $camiones = Camion::all();
        return view('mantenimientos.create', compact('camiones'));
    }

    // Guardar un nuevo mantenimiento
    public function store(Request $request)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'tipo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'costo' => 'nullable|numeric',
            'proveedor' => 'nullable|string|max:255',
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento registrado correctamente.');
    }

    // Mostrar un mantenimiento específico
    public function show(Mantenimiento $mantenimiento)
    {
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
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'costo' => 'nullable|numeric',
            'proveedor' => 'nullable|string|max:255',
        ]);

        $mantenimiento->update($request->all());

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado correctamente.');
    }

    // Eliminar mantenimiento
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado correctamente.');
    }
}
