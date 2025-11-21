@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Registrar Ingreso de Visitante</h1>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('visitas.procesar') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Número de Identificación</label>
                    <input type="text" name="identificacion" class="form-control" required placeholder="Ingrese cédula del visitante">
                </div>

                <button class="btn btn-primary">
                    <i class="fa-solid fa-search"></i> Buscar Visitante
                </button>
            </form>

        </div>
    </div>
@endsection
