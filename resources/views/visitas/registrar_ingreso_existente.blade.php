@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Registrar Ingreso - Visitante Existente</h1>

    <div class="card">
        <div class="card-body">

            <h5>Datos del visitante</h5>
            <p><strong>Nombre:</strong> {{ $visitante->nombre }}</p>
            <p><strong>Identificación:</strong> {{ $visitante->identificacion }}</p>
            <p><strong>Celular:</strong> {{ $visitante->celular }}</p>
            <p><strong>Tipo de visitante:</strong> {{ ucfirst($visitante->tipo_visitante) }}</p>
            @if($visitante->tipo_visitante === 'trabajador')
                <p><strong>Oficio:</strong> {{ $visitante->oficio }}</p>
            @endif

            <hr>

            <form action="{{ route('visitas.ingreso.existente') }}" method="POST">
                @csrf

                <input type="hidden" name="visitante_id" value="{{ $visitante->id }}">

                <div class="mb-3">
                    <label class="form-label">Apartamento a visitar</label>
                    <select name="apartamento_id" class="form-select" required>
                        <option value="">Seleccione un apartamento</option>
                        @foreach($apartamentos as $apto)
                            <option value="{{ $apto->id }}">
                                {{ $apto->torre->nombre }} - {{ $apto->numero }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-success">
                    <i class="fa-solid fa-door-open"></i> Registrar Ingreso
                </button>

                <a href="{{ route('visitas.buscar') }}" class="btn btn-secondary">Cancelar</a>

            </form>
        </div>
    </div>
@endsection
