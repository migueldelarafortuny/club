@extends('layout')
@section('content')
    <h1>Equipos</h1>
    <p>Esta es la página de equipos del club deportivo.</p>
    @if (empty($equipos))
        <p>No hay equipos disponibles.</p>
    @else
        <ul>
            @foreach ($equipos as $equipo)
                <li>
                    <a href="{{ route('equipo.show', ['id' => $equipo['id']]) }}">
                        {{ $equipo['name'] }} — {{ $equipo['season'] }} — {{ $equipo['category'] }} — {{ $equipo['coach'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    @if (!empty($vistosRecientemente))
        <h2>Vistos recientemente</h2>
        <ul>
            @foreach ($vistosRecientemente as $equipo)
                <li>
                    <a href="{{ route('equipo.show', ['id' => $equipo['id']]) }}">
                        {{ $equipo['id'] }} - {{ $equipo['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    <br>
     <p><a href="{{ route('equipo.create') }}">Añadir un nuevo equipo</a></p>
    <br>
    <p>Total de equipos: {{ count($equipos) }}</p>
    <br>
    <p>Categorías distintas: {{ count(array_unique(array_column($equipos, 'category'))) }}</p>

@endsection
