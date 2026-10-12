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

    function welcome(){
        return view('inicio');
    }

    function equipos(){
        return view('equipos', ['equipos' => $this->equipos]);
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
        $equipo = $this->equipos[$id] ?? null;
        return view('ficha-equipo', ['equipo' => $equipo]);
    }
}
