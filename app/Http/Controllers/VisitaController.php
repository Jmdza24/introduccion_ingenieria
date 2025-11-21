<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Apartamento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    /**
     * Mostrar formulario inicial para buscar visitante por cédula
     */
    public function buscarVisitante()
    {
        return view('visitas.buscar');
    }

    /**
     * Procesar la búsqueda por cédula:
     * - Si existe → cargar datos y mostrar formulario de ingreso
     * - Si no existe → mostrar formulario para registrar nuevo visitante
     */
    public function procesarBusqueda(Request $request)
    {
        $request->validate([
            'identificacion' => 'required'
        ]);

        $visitante = Visitante::where('identificacion', $request->identificacion)->first();

        $apartamentos = Apartamento::with('torre')->get();

        if ($visitante) {
            // Visitante existe → mostrar formulario con datos autocompletados
            return view('visitas.registrar_ingreso_existente', compact('visitante', 'apartamentos'));
        } else {
            // Visitante NO existe → mostrar formulario para registrarlo
            $identificacion = $request->identificacion;

            return view('visitas.registrar_ingreso_nuevo', compact('identificacion', 'apartamentos'));
        }
    }

    /**
     * Registrar ingreso de visitante nuevo
     */
    public function registrarIngresoNuevo(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'identificacion' => 'required|unique:visitantes,identificacion',
            'celular' => 'required',
            'tipo_visitante' => 'required|in:normal,trabajador',
            'oficio' => 'nullable|string',
            'apartamento_id' => 'required|exists:apartamentos,id',
        ]);

        // Validar horario según tipo
        if (!$this->validarHorario($request->tipo_visitante)) {
            return redirect()->route('visitas.buscar')->with('error', 'Horario no permitido para el tipo de visitante.');
        }

        // Crear visitante
        $visitante = Visitante::create($request->only([
            'nombre', 'identificacion', 'celular', 'tipo_visitante', 'oficio'
        ]));

        // Registrar ingreso
        $this->registrarIngreso($visitante->id, $request->apartamento_id);

        return redirect()->route('visitas.hoy')->with('success', 'Ingreso registrado correctamente.');
    }

    /**
     * Registrar ingreso de visitante existente
     */
    public function registrarIngresoExistente(Request $request)
    {
        $request->validate([
            'visitante_id' => 'required|exists:visitantes,id',
            'apartamento_id' => 'required|exists:apartamentos,id',
        ]);

        $visitante = Visitante::findOrFail($request->visitante_id);

        // Validar horario
        if (!$this->validarHorario($visitante->tipo_visitante)) {
            return redirect()->route('visitas.buscar')->with('error', 'Horario no permitido para el tipo de visitante.');
        }

        // Registrar ingreso
        $this->registrarIngreso($visitante->id, $request->apartamento_id);

        return redirect()->route('visitas.hoy')->with('success', 'Ingreso registrado correctamente.');
    }

    /**
     * Función que realmente registra la visita
     */
    private function registrarIngreso($visitante_id, $apartamento_id)
    {
        Visita::create([
            'visitante_id' => $visitante_id,
            'apartamento_id' => $apartamento_id,
            'fecha_ingreso' => Carbon::now()->format('Y-m-d'),
            'hora_ingreso' => Carbon::now()->format('H:i:s'),
        ]);
    }

    /**
     * Validar el horario de ingreso según el tipo de visitante
     */
    private function validarHorario($tipo)
    {
        $horaActual = Carbon::now()->format('H:i');

        if ($tipo === 'trabajador') {
            if ($horaActual < '07:00' || $horaActual > '18:00') {
                session()->flash('error', 'Los trabajadores solo pueden ingresar entre 07:00 y 18:00.');
                return false;
            }
        }

        if ($tipo === 'normal') {
            if ($horaActual < '04:00' || $horaActual > '22:00') {
                session()->flash('error', 'Los visitantes solo pueden ingresar entre 04:00 y 22:00.');
                return false;
            }
        }

        return true;
    }


    /**
     * Registrar salida del visitante
     */
    public function registrarSalida($id)
    {
        $visita = Visita::findOrFail($id);

        $visita->update([
            'fecha_salida' => Carbon::now()->format('Y-m-d'),
            'hora_salida' => Carbon::now()->format('H:i:s'),
        ]);

        return back()->with('success', 'Salida registrada correctamente.');
    }

    /**
     * Mostrar visitantes que están dentro actualmente (sin salida registrada)
     */
    public function visitantesDentro()
    {
        $visitas = Visita::with('visitante', 'apartamento.torre')
            ->whereNull('fecha_salida')
            ->get();

        return view('visitas.dentro', compact('visitas'));
    }

    /**
     * Ver visitas del día (solo para vigilante/admin)
     */
    public function visitasHoy()
    {
        $hoy = Carbon::now()->format('Y-m-d');

        $visitas = Visita::with('visitante', 'apartamento.torre')
            ->where('fecha_ingreso', $hoy)
            ->get();

        return view('visitas.hoy', compact('visitas'));
    }

    public function historialTotal()
    {
        $visitas = Visita::with('visitante', 'apartamento.torre')
            ->orderBy('fecha_ingreso', 'desc')
            ->orderBy('hora_ingreso', 'desc')
            ->get();

        return view('visitas.admin.historial', compact('visitas'));
    }

    public function consultaFecha()
    {
        return view('visitas.admin.consulta_fecha');
    }

    public function procesarConsultaFecha(Request $request)
    {
        $request->validate([
            'desde' => 'required|date',
            'hasta' => 'required|date|after_or_equal:desde',
        ]);

        $visitas = Visita::with('visitante', 'apartamento.torre')
            ->whereBetween('fecha_ingreso', [$request->desde, $request->hasta])
            ->orderBy('fecha_ingreso', 'desc')
            ->get();

        return view('visitas.admin.resultado_fecha', compact('visitas', 'request'));
    }

    public function consultaApartamento()
    {
        $apartamentos = Apartamento::with('torre')->get();

        return view('visitas.admin.consulta_apartamento', compact('apartamentos'));
    }

    public function procesarConsultaApartamento(Request $request)
    {
        $request->validate([
            'apartamento_id' => 'required|exists:apartamentos,id'
        ]);

        $visitas = Visita::with('visitante', 'apartamento.torre')
            ->where('apartamento_id', $request->apartamento_id)
            ->orderBy('fecha_ingreso', 'desc')
            ->get();

        return view('visitas.admin.resultado_apartamento', compact('visitas'));
    }

    public function consultaVisitante()
    {
        return view('visitas.admin.consulta_visitante');
    }

    public function procesarConsultaVisitante(Request $request)
    {
        $request->validate([
            'identificacion' => 'required'
        ]);

        $visitante = Visitante::where('identificacion', $request->identificacion)->first();

        if (!$visitante) {
            return back()->with('error', 'No se encontró ningún visitante con esa identificación.');
        }

        $visitas = Visita::with('apartamento.torre')
            ->where('visitante_id', $visitante->id)
            ->orderBy('fecha_ingreso', 'desc')
            ->get();

        return view('visitas.admin.resultado_visitante', compact('visitas', 'visitante'));
    }
}
