@extends('layouts.app')

@section('content')
    <section class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-4">Visitantes Dentro del Conjunto</h1>
        <a href="{{ route('visitas.buscar') }}" class="btn btn-primary">
            Registrar Nueva Visita
        </a>
    </section>

    <div class="card">
        <div class="card-body">

            @if($visitas->count() === 0)
                <p>No hay visitantes dentro del conjunto.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Visitante</th>
                            <th>Identificación</th>
                            <th>Apartamento</th>
                            <th>Hora Ingreso</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitas as $v)
                            <tr>
                                <td>{{ $v->visitante->nombre }}</td>
                                <td>{{ $v->visitante->identificacion }}</td>
                                <td>{{ $v->apartamento->torre->nombre }} - {{ $v->apartamento->numero }}</td>
                                <td>{{ $v->hora_ingreso }}</td>
                                <td>
                                    <a href="{{ route('visitas.salida', $v->id) }}" class="btn btn-danger btn-sm">
                                        Registrar Salida
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
@endsection
