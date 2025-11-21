@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Registrar Ingreso - Nuevo Visitante</h1>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('visitas.ingreso.nuevo') }}" method="POST">
                @csrf

                <input type="hidden" name="identificacion" value="{{ $identificacion }}">

                <div class="mb-3">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Celular</label>
                    <input type="text" name="celular" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Visitante</label>
                    <select name="tipo_visitante" class="form-select" required id="tipoVisitante">
                        <option value="normal">Visitante Normal</option>
                        <option value="trabajador">Trabajador</option>
                    </select>
                </div>

                <div class="mb-3" id="campoOficio" style="display: none;">
                    <label class="form-label">Oficio</label>
                    <input type="text" name="oficio" class="form-control" placeholder="Ej: Plomero, Electricista, Técnico Claro, etc.">
                </div>

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

    <script>
        document.getElementById('tipoVisitante').addEventListener('change', function() {
            const campoOficio = document.getElementById('campoOficio');
            campoOficio.style.display = this.value === 'trabajador' ? 'block' : 'none';
        });
    </script>
@endsection
