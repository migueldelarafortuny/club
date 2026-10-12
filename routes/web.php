<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

/*
 * ICB0006 - Acceso a datos - proyecto base.
 *
 * Aqui solo hay una ruta, y esta para que compruebes que el contenedor
 * responde. Borrala en cuanto escribas las tuyas.
 */

Route::get('/', [RouteController::class, 'welcome'])->name('home');

Route::get('/equipos', [RouteController::class, 'equipos'])->name('equipos');

Route::get('/contacto', [RouteController::class, 'contacto'])->name('contacto');

Route::get('/sobre-el-club', [RouteController::class, 'sobreElClub'])->name('sobre');

Route::get('/creditos', [RouteController::class, 'creditos'])->name('creditos');

Route::get('/equipos/{id}', [RouteController::class, 'ficha'])->name('equipo.index')->whereNumber('id');
