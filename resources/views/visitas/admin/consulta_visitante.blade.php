@extends('layouts.app')

@section('content')
<h1 class="mb-4">Consultar Visitas por Visitante</h1>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body">

        <form action="{{ route('visitas.consulta.visitante.procesar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Identificación del visitante</label>
                <input type="text" name="identificacion" class="form-control" required>
            </div>

            <button class="btn btn-primary">Consultar</button>

        </form>

    </div>
</div>
@endsection
