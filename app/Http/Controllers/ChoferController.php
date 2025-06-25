<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Http\Request;

class ChoferController extends Controller
{
    public function index()
    {
        $choferes = Chofer::all();
        return view('choferes.index', compact('choferes'));
    }

    public function create()
    {
        return view('choferes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'licencia' => 'required|string|max:100',
        ]);

        Chofer::create($request->all());

        return redirect()->route('choferes.index')->with('success', 'Chofer registrado correctamente.');
    }

    public function show(Chofer $chofer)
    {
        return view('choferes.show', compact('chofer'));
    }

    public function edit(Chofer $chofer)
    {
        return view('choferes.edit', compact('chofer'));
    }

    public function update(Request $request, Chofer $chofer)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'licencia' => 'required|string|max:100',
        ]);

        $chofer->update($request->all());

        return redirect()->route('choferes.index')->with('success', 'Chofer actualizado correctamente.');
    }

    public function destroy(Chofer $chofer)
    {
        $chofer->delete();
        return redirect()->route('choferes.index')->with('success', 'Chofer eliminado correctamente.');
    }
}
