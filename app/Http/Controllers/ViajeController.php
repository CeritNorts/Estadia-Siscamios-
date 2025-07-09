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
        $camiones = Camion::all(); 
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
        
        \Log::info('Validación pasada, creando viaje...');
        
        $viaje = Viaje::create($request->all());
        
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
        
        return view('viajes.show', compact('viaje'));
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

        $viaje->update($request->all());

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
}