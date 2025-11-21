<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use App\Models\Torre;
use Illuminate\Http\Request;

class ApartamentoController extends Controller
{
    // Listado de apartamentos
    public function index()
    {
        $apartamentos = Apartamento::with('torre')->get();

        return view('apartamentos.index', compact('apartamentos'));
    }

    // Formulario de creación
    public function create()
    {
        $torres = Torre::all(); // para el select
        return view('apartamentos.create', compact('torres'));
    }

    // Guardar nuevo apartamento
    public function store(Request $request)
    {
        $request->validate([
            'torre_id' => 'required|exists:torres,id',
            'numero' => 'required|unique:apartamentos,numero',
        ]);

        Apartamento::create([
            'torre_id' => $request->torre_id,
            'numero' => $request->numero,
        ]);

        return redirect()->route('apartamentos.index')->with('success', 'Apartamento creado correctamente');
    }

    // Formulario para editar
    public function edit(Apartamento $apartamento)
    {
        $torres = Torre::all();
        return view('apartamentos.edit', compact('apartamento', 'torres'));
    }

    // Actualizar apartamento
    public function update(Request $request, Apartamento $apartamento)
    {
        $request->validate([
            'torre_id' => 'required|exists:torres,id',
            'numero' => 'required|unique:apartamentos,numero,' . $apartamento->id,
        ]);

        $apartamento->update([
            'torre_id' => $request->torre_id,
            'numero' => $request->numero,
        ]);

        return redirect()->route('apartamentos.index')->with('success', 'Apartamento actualizado correctamente');
    }

    // Eliminar apartamento
    public function destroy(Apartamento $apartamento)
    {
        $apartamento->delete();
        return redirect()->route('apartamentos.index')->with('success', 'Apartamento eliminado correctamente');
    }
}
