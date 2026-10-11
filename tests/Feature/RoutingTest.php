<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * Ejercicios 02 y 03 · la tabla de rutas: que contesten, que pasen por un
 * controlador, que el id sea un número y que ninguna vista escriba una URL.
 */
final class RoutingTest extends TestCase
{
    public function test_every_route_answers(): void
    {
        foreach (['/', '/equipos', '/contacto', '/sobre-el-club', '/creditos'] as $url) {
            $this->get($url)->assertOk();
        }
    }

    /**
     * Ninguna ruta se resuelve con una closure: todas apuntan a un método de
     * un controlador. Es la segunda mitad del ejercicio 02, y se comprueba
     * leyendo la tabla de rutas en vez de leyendo el fichero.
     */
    public function test_no_route_is_a_closure(): void
    {
        foreach (Route::getRoutes() as $route) {
            // Estas dos las pone el propio framework, no el alumno: /up es el
            // health check y storage/{path} sirve los ficheros subidos. Las dos
            // son closures y las dos están bien así.
            if ($route->uri() === 'up' || str_starts_with($route->uri(), 'storage/')) {
                continue;
            }

            self::assertIsString(
                $route->getActionName(),
                "La ruta {$route->uri()} no apunta a un controlador.",
            );
            self::assertStringContainsString(
                '@',
                $route->getActionName(),
                "La ruta {$route->uri()} se resuelve con una closure.",
            );
        }
    }

    public function test_a_non_numeric_id_never_reaches_the_controller(): void
    {
        // 404 de la propia tabla de rutas: whereNumber descarta la URL antes
        // de que exista un controlador al que llamar.
        $this->get('/equipos/abc')->assertNotFound();
    }

    /**
     * Ni una URL escrita a mano en ninguna vista. Es lo que hace que renombrar
     * una ruta no obligue a repasar el proyecto entero.
     */
    public function test_no_view_contains_a_literal_url(): void
    {
        $views = glob(resource_path('views').'/{,*/}*.blade.php', GLOB_BRACE) ?: [];

        self::assertNotEmpty($views, 'No se ha encontrado ninguna vista.');

        foreach ($views as $view) {
            $source = (string) file_get_contents($view);

            self::assertDoesNotMatchRegularExpression(
                '/(href|action)\s*=\s*"\/[^"]*"/',
                $source,
                basename($view).' escribe una URL a mano en vez de usar route().',
            );
        }
    }
}
