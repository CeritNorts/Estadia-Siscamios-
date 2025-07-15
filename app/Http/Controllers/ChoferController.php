<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Http\Request;

class ChoferController extends Controller
{
    /**
     * Mostrar lista de choferes
     */
    public function index()
    {
        $choferes = Chofer::all();
        return view('conductores', compact('choferes'));
    }

    /**
     * Mostrar formulario para crear nuevo chofer
     */
    public function create()
    {
        return view('registrarConductor');
    }

    /**
     * Guardar nuevo chofer en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'licencia' => 'required|string|max:100|unique:choferes,licencia',
            'tipoLicencia' => 'nullable|string|max:10',
            'vencimientoLicencia' => 'nullable|date',
            'estado' => 'nullable|string|in:activo,inactivo,suspendido'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'licencia.required' => 'El número de licencia es obligatorio.',
            'licencia.max' => 'El número de licencia no puede tener más de 100 caracteres.',
            'licencia.unique' => 'Este número de licencia ya está registrado.',
            'vencimientoLicencia.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'estado.in' => 'El estado debe ser: activo, inactivo o suspendido.'
        ]);

        Chofer::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'licencia' => $request->licencia,
            'tipo_licencia' => $request->tipoLicencia,
            'vencimiento_licencia' => $request->vencimientoLicencia,
            'estado' => $request->estado ?? 'activo'
        ]);

        return redirect()->route('conductores.index')->with('success', 'Conductor registrado correctamente.');
    }

    /**
     * Mostrar detalles de un chofer específico
     */
    public function show($id)
    {
        $chofer = Chofer::findOrFail($id);
        return view('choferes.show', compact('chofer'));
    }

    /**
     * Mostrar formulario para editar chofer
     */
    public function edit($id)
    {
        $chofer = Chofer::findOrFail($id);
        return view('editarConductor', compact('chofer'));
    }

    /**
     * Actualizar chofer en la base de datos
     */
    public function update(Request $request, $id)
    {
        $chofer = Chofer::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'licencia' => 'required|string|max:100|unique:choferes,licencia,' . $chofer->id,
            'tipoLicencia' => 'nullable|string|max:10',
            'vencimientoLicencia' => 'nullable|date',
            'estado' => 'nullable|string|in:activo,inactivo,suspendido'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'licencia.required' => 'El número de licencia es obligatorio.',
            'licencia.unique' => 'Este número de licencia ya está registrado.',
            'vencimientoLicencia.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'estado.in' => 'El estado debe ser: activo, inactivo o suspendido.'
        ]);

        $chofer->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'licencia' => $request->licencia,
            'tipo_licencia' => $request->tipoLicencia,
            'vencimiento_licencia' => $request->vencimientoLicencia,
            'estado' => $request->estado ?? 'activo'
        ]);

        return redirect()->route('conductores.index')->with('success', 'Conductor actualizado correctamente.');
    }

    /**
     * Eliminar chofer de la base de datos
     */
    public function destroy($id)
    {
        $chofer = Chofer::findOrFail($id);
        $chofer->delete();
        return redirect()->route('conductores.index')->with('success', 'Conductor eliminado correctamente.');
    }
}