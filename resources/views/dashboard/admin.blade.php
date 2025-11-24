@extends('layouts.app')

@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold">Panel de Administración</h1>
    <p class="text-muted fs-5">Bienvenido {{ auth()->user()->name }} al sistema de gestión del conjunto residencial</p>
</div>

<div class="row">

    <!-- TORRES -->
    <div class="col-md-4">
        <a href="{{ route('torres.index') }}" class="text-decoration-none">
            <div class="card shadow-lg card-admin">
                <div class="card-body text-center">
                    <i class="fa-solid fa-building fa-3x mb-3 text-primary"></i>
                    <h4 class="fw-bold">Torres</h4>
                    <p class="text-muted">Gestiona las torres del conjunto</p>
                </div>
            </div>
        </a>
    </div>

    <!-- APARTAMENTOS -->
    <div class="col-md-4">
        <a href="{{ route('apartamentos.index') }}" class="text-decoration-none">
            <div class="card shadow-lg card-admin">
                <div class="card-body text-center">
                    <i class="fa-solid fa-door-open fa-3x mb-3 text-success"></i>
                    <h4 class="fw-bold">Apartamentos</h4>
                    <p class="text-muted">Controla apartamentos registrados</p>
                </div>
            </div>
        </a>
    </div>

    <!-- RESIDENTES -->
    <div class="col-md-4">
        <a href="{{ route('admin.residentes.index') }}" class="text-decoration-none">
            <div class="card shadow-lg card-admin">
                <div class="card-body text-center">
                    <i class="fa-solid fa-users fa-3x mb-3 text-warning"></i>
                    <h4 class="fw-bold">Residentes</h4>
                    <p class="text-muted">Administra los residentes del conjunto</p>
                </div>
            </div>
        </a>
    </div>

    <!-- VISITAS POR FECHA -->
    <div class="col-md-6 mt-4">
        <a href="{{ route('visitas.consulta.fecha') }}" class="text-decoration-none">
            <div class="card shadow-lg card-admin">
                <div class="card-body text-center">
                    <i class="fa-solid fa-calendar-day fa-3x mb-3 text-info"></i>
                    <h4 class="fw-bold">Visitas por Fecha</h4>
                    <p class="text-muted">Consulta todas las visitas registradas en una fecha específica</p>
                </div>
            </div>
        </a>
    </div>

    <!-- REGISTRO DE VISITANTES -->
    <div class="col-md-6 mt-4">
        <a href="{{ route('visitas.consulta.visitante') }}" class="text-decoration-none">
            <div class="card shadow-lg card-admin">
                <div class="card-body text-center">
                    <i class="fa-solid fa-id-card fa-3x mb-3 text-danger"></i>
                    <h4 class="fw-bold">Registro de Visitantes</h4>
                    <p class="text-muted">Registro de Ingreso de un Visitante</p>
                </div>
            </div>
        </a>
    </div>

</div>

<style>
.card-admin {
    border-radius: 20px;
    transition: 0.2s;
}
.card-admin:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 20px rgba(0,0,0,0.15);
}
</style>

@endsection
