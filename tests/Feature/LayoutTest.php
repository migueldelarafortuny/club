<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Ejercicio 04 · el marco. Las cuatro páginas comparten barra y pie, y los
 * enlaces de la barra llevan a algún sitio.
 */
final class LayoutTest extends TestCase
{
    /** Las URL que tienen que llevar el marco puesto. */
    private const PAGES = ['/', '/equipos', '/contacto', '/sobre-el-club'];

    public function test_every_page_shares_the_layout(): void
    {
        foreach (self::PAGES as $url) {
            $this->get($url)
                ->assertOk()
                // La barra y el pie: si una página se los ha copiado en vez de
                // heredarlos, esto pasa igual — pero entonces falla la segunda
                // mitad del ejercicio, que es no repetir la cabecera.
                ->assertSee('<nav', false)
                ->assertSee('<footer>', false)
                ->assertSee('Club', false);
        }
    }

    public function test_the_navigation_links_work(): void
    {
        $home = $this->get('/')->assertOk();

        // Los tres enlaces de la barra, por nombre de ruta: la vista no sabe
        // qué URL son y esta prueba tampoco tiene por qué saberlo.
        foreach (['equipos.index', 'contacto', 'sobre'] as $name) {
            // route() escribe la URL completa en la vista, así que el enlace se
            // busca absoluto y la petición se hace con la ruta relativa.
            $home->assertSee('href="'.route($name).'"', false);
            $this->get(route($name, absolute: false))->assertOk();
        }
    }
}
