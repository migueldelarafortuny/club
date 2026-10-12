@extends('layout')
@section('content')
    <h1>Añadir un nuevo equipo</h1>
    <p>Esta es la página para añadir un nuevo equipo al Club Deportivo.</p>
    <form action="{{ route('equipo.store') }}" method="POST">
        @csrf
        <label for="name">Nombre del equipo:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name') <span class="error">{{ $message }}</span> @enderror<br><br>

        <label for="season">Temporada:</label>
        <input type="text" id="season" name="season" value="{{ old('season') }}">
        @error('season') <span class="error">{{ $message }}</span> @enderror<br><br>

        <label for="category">Categoría:</label>
        <input type="text" id="category" name="category" value="{{ old('category') }}">
        @error('category') <span class="error">{{ $message }}</span> @enderror<br><br>

        <label for="coach">Entrenador:</label>
        <input type="text" id="coach" name="coach" value="{{ old('coach') }}">
        @error('coach') <span class="error">{{ $message }}</span> @enderror<br><br>

        <button type="submit">Añadir equipo</button>
    </form>
@endsection
