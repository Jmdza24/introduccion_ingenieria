@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Torre</h1>

    {{-- Mostrar errores --}}
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
            <form action="{{ route('torres.update', $torre->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nombre de la Torre</label>
                    <input type="text" name="nombre" class="form-control"
                           value="{{ $torre->nombre }}" required>
                </div>

                <button class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Actualizar
                </button>

                <a href="{{ route('torres.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
            </form>
        </div>
    </div>
@endsection
