<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Gestor de Conjuntos</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf

    <label>Email</label>
    <input type="email" name="email" required>

    <br><br>

    <label>Contraseña</label>
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">Ingresar</button>
</form>

</body>
</html>
