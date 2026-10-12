<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouterController extends Controller
{
    function welcome(){
        return view('inicio');
    }

    function equipos(){
        return view('equipos');
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
        return "Ficha del equipo $id.";
    }
}
