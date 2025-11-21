@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Visitas del Día</h1>

    <div class="card">
        <div class="card-body">

            @if($visitas->count() === 0)
                <p>No hay visitas registradas hoy.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Visitante</th>
                            <th>Identificación</th>
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
                                <td>{{ $v->hora_ingreso }}</td>
                                <td>{{ $v->hora_salida ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
@endsection
