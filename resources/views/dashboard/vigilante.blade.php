@extends('layouts.app')

@section('content')

<div class="text-center mb-4">
    <h1 class="fw-bold">Bienvenido, Vigilante</h1>
    <p class="text-muted">Gestión rápida de visitantes y control de accesos</p>
</div>

<div class="row">

    <!-- Registrar ingreso -->
    <div class="col-md-4">
        <a href="{{ route('visitas.buscar') }}" class="text-decoration-none">
            <div class="card shadow-sm card-small">
                <div class="card-body text-center">
                    <i class="fa-solid fa-user-plus fa-2x text-primary mb-2"></i>
                    <h5 class="fw-bold">Registrar Visita</h5>
                </div>
            </div>
        </a>
    </div>

    <!-- Visitantes dentro -->
    <div class="col-md-4">
        <a href="{{ route('visitas.dentro') }}" class="text-decoration-none">
            <div class="card shadow-sm card-small">
                <div class="card-body text-center">
                    <i class="fa-solid fa-person-walking-arrow-right fa-2x text-danger mb-2"></i>
                    <h5 class="fw-bold">Visitantes Dentro</h5>
                </div>
            </div>
        </a>
    </div>

    <!-- Listar Residentes -->
    <div class="col-md-4">
        <a href="{{ route('vigilante.residentes.index') }}" class="text-decoration-none">
            <div class="card shadow-sm card-small">
                <div class="card-body text-center">
                    <i class="fa-solid fa-users fa-2x text-success mb-2"></i>
                    <h5 class="fw-bold">Residentes</h5>
                </div>
            </div>
        </a>
    </div>

</div>

<!-- Últimas visitas -->
<div class="card mt-5 shadow-sm">
    <div class="card-header">
        <h5 class="fw-bold">Últimas 5 visitas registradas</h5>
    </div>

    <div class="card-body">
        @if($ultimas->count() === 0)
            <p class="text-muted">No hay visitas registradas aún.</p>
        @else
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Visitante</th>
                        <th>Apartamento</th>
                        <th>Torre</th>
                        <th>Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ultimas as $v)
                        <tr>
                            <td>{{ $v->visitante->nombre }}</td>
                            <td>{{ $v->apartamento->numero }}</td>
                            <td>{{ $v->apartamento->torre->nombre }}</td>
                            <td>{{ $v->fecha_ingreso }} {{ $v->hora_ingreso }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<style>
.card-small {
    border-radius: 15px;
    transition: 0.2s;
}
.card-small:hover {
    transform: translateY(-4px);
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
</style>

@endsection
