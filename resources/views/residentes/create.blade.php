@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Registrar Nuevo Residente</h1>

    {{-- Errores --}}
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
            <form action="{{ route('residentes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" required
                           value="{{ old('nombre') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Identificación</label>
                    <input type="text" name="identificacion" class="form-control" required
                           value="{{ old('identificacion') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Celular</label>
                    <input type="text" name="celular" class="form-control" required
                           value="{{ old('celular') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Apartamento</label>
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
                    <i class="fa-solid fa-save"></i> Guardar
                </button>

                <a href="{{ route('admin.residentes.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
            </form>
        </div>
    </div>
@endsection
