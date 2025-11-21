<?php

namespace App\Http\Controllers;

use App\Models\Torre;
use Illuminate\Http\Request;

class TorreController extends Controller
{
    // Mostrar listado de torres
    public function index()
    {
        $torres = Torre::all();
        return view('torres.index', compact('torres'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('torres.create');
    }

    // Guardar nueva torre
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:torres,nombre',
        ]);

        Torre::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('torres.index')->with('success', 'Torre creada correctamente');
    }

    // Formulario de edición
    public function edit(Torre $torre)
    {
        return view('torres.edit', compact('torre'));
    }

    // Actualizar torre
    public function update(Request $request, Torre $torre)
    {
        $request->validate([
            'nombre' => 'required|unique:torres,nombre,' . $torre->id,
        ]);

        $torre->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('torres.index')->with('success', 'Torre actualizada correctamente');
    }

    // Eliminar torre
    public function destroy(Torre $torre)
    {
        $torre->delete();

        return redirect()->route('torres.index')->with('success', 'Torre eliminada correctamente');
    }
}
