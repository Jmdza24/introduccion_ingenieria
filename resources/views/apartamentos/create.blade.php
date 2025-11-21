@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Nuevo Apartamento</h1>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('apartamentos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Torre</label>
                    <select name="torre_id" class="form-select" required>
                        <option value="">Seleccione una torre</option>
                        @foreach($torres as $torre)
                            <option value="{{ $torre->id }}" {{ old('torre_id') == $torre->id ? 'selected' : '' }}>
                                {{ $torre->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Número de Apartamento</label>
                    <input type="text" name="numero" class="form-control"
                           value="{{ old('numero') }}" required
                           placeholder="Ejemplo: 101 o A-11">
                </div>

                <button class="btn btn-success">
                    <i class="fa-solid fa-save"></i> Guardar
                </button>

                <a href="{{ route('apartamentos.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
            </form>
        </div>
    </div>
@endsection
