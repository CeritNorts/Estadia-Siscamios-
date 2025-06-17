<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Camion;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    // Listar documentos
    public function index()
    {
        $documentos = Documento::with('camion')->paginate(10);
        return view('documentos.index', compact('documentos'));
    }

    // Formulario para crear documento
    public function create()
    {
        $camiones = Camion::all();
        return view('documentos.create', compact('camiones'));
    }

    // Guardar documento
    public function store(Request $request)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'tipo' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'vencimiento' => 'nullable|date',
        ]);

        Documento::create($request->all());

        return redirect()->route('documentos.index')->with('success', 'Documento registrado correctamente.');
    }

    // Mostrar documento específico
    public function show(Documento $documento)
    {
        return view('documentos.show', compact('documento'));
    }

    // Formulario para editar documento
    public function edit(Documento $documento)
    {
        $camiones = Camion::all();
        return view('documentos.edit', compact('documento', 'camiones'));
    }

    // Actualizar documento
    public function update(Request $request, Documento $documento)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,id',
            'tipo' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'vencimiento' => 'nullable|date',
        ]);

        $documento->update($request->all());

        return redirect()->route('documentos.index')->with('success', 'Documento actualizado correctamente.');
    }

    // Eliminar documento
    public function destroy(Documento $documento)
    {
        $documento->delete();

        return redirect()->route('documentos.index')->with('success', 'Documento eliminado correctamente.');
    }
}
