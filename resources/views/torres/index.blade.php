@extends('layouts.app')

@section('content')
    <section class="d-flex justify-content-between align-items-center mb-4">
        <h1>Torres Registradas</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>
    </section>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('torres.create') }}" class="btn btn-primary mb-3">
        <i class="fa-solid fa-plus"></i> Nueva Torre
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($torres as $torre)
                        <tr>
                            <td>{{ $torre->id }}</td>
                            <td>{{ $torre->nombre }}</td>
                            <td>
                                <a href="{{ route('torres.edit', $torre) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen"></i> Editar
                                </a>

                                <form action="{{ route('torres.destroy', $torre) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Deseas eliminar esta torre?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
