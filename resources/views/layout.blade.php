<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="menu">
        <!-- Definición de la barra de navegación de la web -->
        <ul>
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('equipos.index') }}">Equipos</a></li>
            <li><a href="{{ route('contacto') }}">Contacto</a></li>
            <li><a href="{{ route('sobre') }}">Sobre el club</a></li>
            <li><a href="{{ route('creditos') }}">Créditos</a></li>
        </ul>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
<footer>
    <p>&copy; {{ date('Y') }} {{ config('app.name') }} Deportivo. Desde 1990.</p>
</footer>
</html>
