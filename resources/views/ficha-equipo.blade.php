@extends('layout')
@section('content')

    @if ($equipo === null)
        <h1>Equipo no encontrado</h1>
        <p>No existe ningún equipo con ese identificador.</p>
    @else

        <h1>Ficha del {{ $equipo['name'] }}</h1>
        <p>Esta es la página de ficha del {{ $equipo['name'] }} del Club Deportivo.</p>
        <ul>
            <li>Nombre: {{ $equipo['name'] }}</li>
            <li>Temporada: {{ $equipo['season'] }}</li>
            <li>Categoría: {{ $equipo['category'] }}</li>
            <li>Entrenador: {{ $equipo['coach'] }}</li>
        </ul>
    @endif
@endsection
