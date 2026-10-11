<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Ejercicio 01 · el proyecto arranca y no habla con ninguna base de datos.
 */
final class ProjectTest extends TestCase
{
    public function test_the_home_page_says_club(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Club Deportivo');
    }

    /**
     * Se comprueba por lo negativo a propósito: al ejecutar las pruebas,
     * phpunit.xml pone sesión y caché en «array» en vez de en «file», así que
     * el valor exacto cambia según dónde mires. Lo que no puede cambiar nunca
     * es que ninguno de los tres apunte a «database».
     */
    public function test_the_application_needs_no_database(): void
    {
        self::assertNotSame('database', config('session.driver'));
        self::assertNotSame('database', config('cache.default'));
        self::assertNotSame('database', config('queue.default'));
        self::assertDirectoryDoesNotExist(base_path('database'));
    }
}
