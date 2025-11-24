@extends('layouts.app')

@section('content')
<section class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-4">Visitas de {{ $visitante->nombre }}</h1>
    <a href="{{ route('visitas.consulta.visitante') }}" class="btn btn-primary"> 
        <i class="fa-solid fa-angle-left"></i> Volver
    </a>
</section>

@if($visitas->count() === 0)
    <p>Este visitante no tiene registros.</p>
@else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Apartamento</th>
                <th>Ingreso</th>
                <th>Salida</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitas as $v)
                <tr>
                    <td>{{ $v->apartamento->torre->nombre }} - {{ $v->apartamento->numero }}</td>
                    <td>{{ $v->fecha_ingreso }} {{ $v->hora_ingreso }}</td>
                    <td>{{ $v->fecha_salida ?? '—' }} {{ $v->hora_salida ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
