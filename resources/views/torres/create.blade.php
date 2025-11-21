@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Nueva Torre</h1>

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
            <form action="{{ route('torres.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre de la Torre</label>
                    <input type="text" name="nombre" class="form-control" required placeholder="Ejemplo: Torre A">
                </div>

                <button class="btn btn-success">
                    <i class="fa-solid fa-save"></i> Guardar
                </button>

                <a href="{{ route('torres.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
            </form>
        </div>
    </div>
@endsection
