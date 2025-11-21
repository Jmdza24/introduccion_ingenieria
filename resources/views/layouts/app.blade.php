<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Conjuntos</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Iconos FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- CSS personalizado --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    {{-- SIDEBAR --}}
    <x-sidebar />

    <div class="main-content">
        @yield('content')
    </div>

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Acceso no permitido',
            text: "{{ session('error') }}"
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: "{{ session('success') }}"
        });
    </script>
    @endif

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
