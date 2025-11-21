<?php

namespace App\Http\Controllers;

use App\Models\Residente;
use App\Models\Apartamento;
use Illuminate\Http\Request;

class ResidenteController extends Controller
{
    // Listado de residentes
    public function index()
    {
        $residentes = Residente::select('residentes.*')
            ->join('apartamentos', 'apartamentos.id', '=', 'residentes.apartamento_id')
            ->join('torres', 'torres.id', '=', 'apartamentos.torre_id')
            ->orderBy('torres.nombre', 'asc')
            ->orderBy('apartamentos.numero', 'asc')
            ->orderBy('residentes.nombre', 'asc')
            ->with('apartamento.torre')
            ->get();


        return view('residentes.index', compact('residentes'));
    }

    // Formulario de creación
    public function create()
    {
        $apartamentos = Apartamento::with('torre')->get();
        return view('residentes.create', compact('apartamentos'));
    }

    // Guardar nuevo residente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'identificacion' => 'required|unique:residentes,identificacion',
            'celular' => 'required',
            'apartamento_id' => 'required|exists:apartamentos,id',
        ]);

        Residente::create([
            'nombre' => $request->nombre,
            'identificacion' => $request->identificacion,
            'celular' => $request->celular,
            'apartamento_id' => $request->apartamento_id,
        ]);

        return redirect()->route('residentes.index')->with('success', 'Residente creado correctamente');
    }

    // Formulario para editar
    public function edit(Residente $residente)
    {
        $apartamentos = Apartamento::with('torre')->get();
        return view('residentes.edit', compact('residente', 'apartamentos'));
    }

    // Actualizar residente
    public function update(Request $request, Residente $residente)
    {
        $request->validate([
            'nombre' => 'required',
            'identificacion' => 'required|unique:residentes,identificacion,' . $residente->id,
            'celular' => 'required',
            'apartamento_id' => 'required|exists:apartamentos,id',
        ]);

        $residente->update([
            'nombre' => $request->nombre,
            'identificacion' => $request->identificacion,
            'celular' => $request->celular,
            'apartamento_id' => $request->apartamento_id,
        ]);

        return redirect()->route('residentes.index')->with('success', 'Residente actualizado correctamente');
    }

    // Eliminar residente
    public function destroy(Residente $residente)
    {
        $residente->delete();

        return redirect()->route('residentes.index')->with('success', 'Residente eliminado correctamente');
    }
}
