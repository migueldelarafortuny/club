<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClubController extends Controller
{
    function welcome(){
        return 'Club Deportivo';
    }

    function equipos(){
        return 'Esta es la página de equipos.';
    }

    function contacto(){
        return 'Esta es la página de contacto.';
    }

    function sobreElClub(){
        return 'Esta es la página sobre el club.';
    }

    function creditos(){
        return 'Esta es la página de créditos.';
    }
}
