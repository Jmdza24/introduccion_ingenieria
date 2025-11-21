@extends('layouts.app')

@section('content')
<h1 class="mb-4">Consultar Visitas por Apartamento</h1>

<div class="card">
    <div class="card-body">

        <form action="{{ route('visitas.consulta.apartamento.procesar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Apartamento</label>
                <select name="apartamento_id" class="form-select" required>
                    <option value="">Seleccione</option>
                    @foreach($apartamentos as $apto)
                        <option value="{{ $apto->id }}">
                            {{ $apto->torre->nombre }} - {{ $apto->numero }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Consultar</button>

        </form>

    </div>
</div>
@endsection
