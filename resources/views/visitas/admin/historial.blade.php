@extends('layouts.app')

@section('content')
<h1 class="mb-4">Historial Completo de Visitas</h1>

<div class="card">
    <div class="card-body">

        @if($visitas->count() === 0)
            <p>No hay registros de visitas.</p>
        @else

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Visitante</th>
                        <th>Cédula</th>
                        <th>Apartamento</th>
                        <th>Ingreso</th>
                        <th>Salida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitas as $v)
                        <tr>
                            <td>{{ $v->visitante->nombre }}</td>
                            <td>{{ $v->visitante->identificacion }}</td>
                            <td>{{ $v->apartamento->torre->nombre }} - {{ $v->apartamento->numero }}</td>
                            <td>{{ $v->fecha_ingreso }} {{ $v->hora_ingreso }}</td>
                            <td>{{ $v->fecha_salida ? $v->fecha_salida.' '.$v->hora_salida : '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif

    </div>
</div>
@endsection
