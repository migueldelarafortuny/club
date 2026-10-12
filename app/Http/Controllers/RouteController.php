<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    private $equipos = [
        1 => ['id' => 1, 'name' => 'Team 1', 'season' => '2021', 'category' => 'First Division', 'coach' => 'Coach 1'],
        ['id' => 2, 'name' => 'Team 2', 'season' => '2022', 'category' => 'First Division', 'coach' => 'Coach 2'],
        ['id' => 3, 'name' => 'Team 3', 'season' => '2023', 'category' => 'First Division', 'coach' => 'Coach 3'],
        ['id' => 4, 'name' => 'Team 4', 'season' => '2019', 'category' => 'First Division', 'coach' => 'Coach 4'],
        ['id' => 5, 'name' => 'Team 5', 'season' => '2025', 'category' => 'First Division', 'coach' => 'Coach 5'],
        ['id' => 6, 'name' => 'Team 6', 'season' => '2025', 'category' => 'Second Division', 'coach' => 'Coach 6'],
        ['id' => 7, 'name' => 'Team 7', 'season' => '2026', 'category' => 'First Division', 'coach' => 'Coach 7'],
        ['id' => 8, 'name' => 'Team 8', 'season' => '2026', 'category' => 'Second Division', 'coach' => 'Coach 8'],
        ['id' => 9, 'name' => 'Team 9', 'season' => '2026', 'category' => 'Third Division', 'coach' => 'Coach 9'],
        ['id' => 10, 'name' => 'Team 10', 'season' => '2023', 'category' => 'First Division', 'coach' => 'Coach 10']
    ];

    private function listaEquipos(): array
    {
        return session('equipos', $this->equipos);
    }

    function welcome(){
        return view('inicio');
    }

    function equipos(){
        return view('equipos', ['equipos' => $this->listaEquipos()]);
    }

    function contacto(){
        return view('contacto');
    }

    function sobreElClub(){
        return view('sobre-el-club');
    }

    function creditos(){
        return 'Esta es la página de créditos.';
    }

    function ficha($id){
        $equipos = $this->listaEquipos();
        return view('ficha-equipo', ['equipo' => $equipos[$id] ?? null]);
    }

    function nuevo(){
        return view('anadir-equipo');
    }

    function store(Request $request){
        // 1. Validar. Devuelve SOLO los campos validados, ya limpios.
        $datos = $request->validate([
            'name'     => 'required|string|min:2',
            'category' => 'required|string',
            'coach'    => 'required|string',
            'season'   => 'required|digits:4',
        ]);

        // 2. Partir de la lista actual.
        $equipos = $this->listaEquipos();

        // 3. Generar el id: el mayor que haya, más uno.
        $id = empty($equipos) ? 1 : max(array_keys($equipos)) + 1;
        $datos['id'] = $id;

        // 4. Añadirlo, usando el id como clave (igual que el resto).
        $equipos[$id] = $datos;

        // 5. Guardar la lista entera en sesión. ESTO es lo que sobrevive.
        session(['equipos' => $equipos]);

        return redirect()->route('equipos.index');
    }
}
