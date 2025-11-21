@extends('layouts.app')

@section('content')
<h1 class="mb-4">Consultar Visitas por Fecha</h1>

<div class="card">
    <div class="card-body">

        <form action="{{ route('visitas.consulta.fecha.procesar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Desde</label>
                <input type="date" name="desde" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Hasta</label>
                <input type="date" name="hasta" class="form-control" required>
            </div>

            <button class="btn btn-primary">Consultar</button>
        </form>

    </div>
</div>
@endsection
