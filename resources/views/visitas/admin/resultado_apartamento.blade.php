@extends('layouts.app')

@section('content')
<section class="d-flex justify-content-between align-items-center mb-4">
    <h1>Visitas por Apartamento</h1>
    <a href="{{ route('visitas.consulta.apartamento') }}" class="btn btn-primary mb-3">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>
</section>

@if($visitas->count() === 0)
    <p>No hay visitas registradas para este apartamento.</p>
@else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Visitante</th>
                <th>Cédula</th>
                <th>Ingreso</th>
                <th>Salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitas as $v)
                <tr>
                    <td>{{ $v->visitante->nombre }}</td>
                    <td>{{ $v->visitante->identificacion }}</td>
                    <td>{{ $v->fecha_ingreso }} {{ $v->hora_ingreso }}</td>
                    <td>{{ $v->fecha_salida ?? '—' }} {{ $v->hora_salida ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
