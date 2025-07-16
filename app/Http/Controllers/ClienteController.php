<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes', compact('clientes')); 
    }

    public function create()
    {
        return view('registrarCliente');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'contrato' => 'required|string',
            'tipo' => 'required|string|in:empresa,particular', 
            'estado' => 'required|string|in:activo,inactivo', 
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'contacto.required' => 'El contacto es obligatorio.',
            'contacto.max' => 'El contacto no puede tener más de 255 caracteres.',
            'contrato.required' => 'El contrato es obligatorio.',
            'tipo.required' => 'El tipo de cliente es obligatorio.', 
            'tipo.in' => 'El tipo de cliente debe ser "Empresa" o "Particular".', 
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser "Activo" o "Inactivo".',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('editarCliente', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'contrato' => 'required|string',
            'tipo' => 'required|string|in:empresa,particular', 
            'estado' => 'required|string|in:activo,inactivo', 
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'contacto.required' => 'El contacto es obligatorio.',
            'contacto.max' => 'El contacto no puede tener más de 255 caracteres.',
            'contrato.required' => 'El contrato es obligatorio.',
            'tipo.required' => 'El tipo de cliente es obligatorio.',
            'tipo.in' => 'El tipo de cliente debe ser "Empresa" o "Particular".',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser "Activo" o "Inactivo".',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}