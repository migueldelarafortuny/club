<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

/*
 * ICB0006 - Acceso a datos - proyecto base.
 *
 * Aqui solo hay una ruta, y esta para que compruebes que el contenedor
 * responde. Borrala en cuanto escribas las tuyas.
 */

Route::get('/', [TeamController::class, 'welcome'])->name('home');

Route::get('/equipos', [TeamController::class, 'equipos'])->name('equipos.index');

Route::get('/contacto', [TeamController::class, 'contacto'])->name('contacto');

Route::get('/sobre-el-club', [TeamController::class, 'sobreElClub'])->name('sobre');

Route::get('/creditos', [TeamController::class, 'creditos'])->name('creditos');

Route::get('/equipos/nuevo', [TeamController::class, 'nuevo'])->name('equipo.create');

Route::get('/equipos/{id}', [TeamController::class, 'ficha'])->name('equipo.show')->whereNumber('id');

Route::post('/equipos', [TeamController::class, 'store'])->name('equipo.store');
