@extends('layouts.app')

@section('content')
    <section class="d-flex justify-content-between align-items-center mb-4">
        <h1>Apartamentos Registrados</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>
    </section>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('apartamentos.create') }}" class="btn btn-primary mb-3">
        <i class="fa-solid fa-plus"></i> Nuevo Apartamento
    </a>

    <div class="card">
        <div class="card-body">
            @if($apartamentos->count() === 0)
                <p>No hay apartamentos registrados aún.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Apartamento</th>
                            <th>Torre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($apartamentos as $apartamento)
                            <tr>
                                <td>{{ $apartamento->id }}</td>
                                <td>{{ $apartamento->numero }}</td>
                                <td>{{ $apartamento->torre->nombre }}</td>
                                <td>
                                    <a href="{{ route('apartamentos.edit', $apartamento) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>

                                    <form action="{{ route('apartamentos.destroy', $apartamento) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Deseas eliminar este apartamento?')">
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
            @endif
        </div>
    </div>
@endsection
