<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouterController;

/*
 * ICB0006 - Acceso a datos - proyecto base.
 *
 * Aqui solo hay una ruta, y esta para que compruebes que el contenedor
 * responde. Borrala en cuanto escribas las tuyas.
 */

Route::get('/', [RouterController::class, 'welcome'])->name('home');

Route::get('/equipos', [RouterController::class, 'equipos'])->name('equipos.index');

Route::get('/contacto', [RouterController::class, 'contacto'])->name('contacto');

Route::get('/sobre-el-club', [RouterController::class, 'sobreElClub'])->name('sobre');

Route::get('/creditos', [RouterController::class, 'creditos'])->name('creditos');

Route::get('/equipos/{id}', [RouterController::class, 'ficha'])->name('equipo.show')->whereNumber('id');
