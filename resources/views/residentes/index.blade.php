@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Residentes Registrados</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('residentes.create') }}" class="btn btn-primary mb-3">
        <i class="fa-solid fa-plus"></i> Nuevo Residente
    </a>

    <div class="card">
        <div class="card-body">
            @if($residentes->count() === 0)
                <p>No hay residentes registrados aún.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Identificación</th>
                            <th>Celular</th>
                            <th>Apartamento</th>
                            <th>Torre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($residentes as $residente)
                            <tr>
                                <td>{{ $residente->id }}</td>
                                <td>{{ $residente->nombre }}</td>
                                <td>{{ $residente->identificacion }}</td>
                                <td>{{ $residente->celular }}</td>
                                <td>{{ $residente->apartamento->numero }}</td>
                                <td>{{ $residente->apartamento->torre->nombre }}</td>
                                <td>
                                    <a href="{{ route('residentes.edit', $residente) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>

                                    <form action="{{ route('residentes.destroy', $residente) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Deseas eliminar este residente?')">
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
