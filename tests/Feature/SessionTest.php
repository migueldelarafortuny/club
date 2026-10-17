<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Ejercicio 08 · mensajes y estado. El POST redirige, el mensaje vive una sola
 * petición, y la lista de recientes guarda cuatro con el último primero.
 */
final class SessionTest extends TestCase
{
    public function test_adding_a_team_redirects_with_a_message(): void
    {
        $this->post('/equipos', [
            'name'     => 'Alevín B',
            'category' => 'Alevín',
            'season'   => '2026',
            'coach'    => 'Toni Grau',
        ])
            // Redirección, no vista: por eso el F5 del navegador no reenvía el
            // formulario.
            ->assertRedirect('/equipos')
            ->assertSessionHas('status', 'Equipo añadido.');

        $this->get('/equipos')->assertSee('Equipo añadido.');
    }

    public function test_the_message_is_gone_on_the_next_request(): void
    {
        // Se pasa por el flujo de verdad, porque lo que se comprueba es cuánto
        // vive el mensaje: `withSession` lo dejaría puesto como dato normal de
        // sesión y entonces la prueba no probaría nada.
        $this->post('/equipos', [
            'name'     => 'Infantil B',
            'category' => 'Infantil',
            'season'   => '2026',
            'coach'    => 'Berta Clos',
        ])->assertRedirect('/equipos');

        // Primera petición después de la redirección: el mensaje está.
        $this->get('/equipos')->assertSee('Equipo añadido.');

        // Segunda: ya no. Si sigue apareciendo, se guardó con put() en vez de
        // pasarlo como flash con with().
        $this->get('/equipos')->assertDontSee('Equipo añadido.');
    }

    public function test_recently_viewed_keeps_four_newest_first(): void
    {
        // Los ids salen del propio listado: no depende de qué equipos haya.
        preg_match_all('#/equipos/(\d+)"#', (string) $this->get('/equipos')->getContent(), $m);
        $ids = array_values(array_unique($m[1]));

        // Cinco fichas abiertas en orden.
        foreach (array_slice($ids, 0, 5) as $id) {
            $this->get('/equipos/'.$id)->assertOk();
        }

        $this->get('/equipos')
            // Cuatro, no cinco: la quinta visita echó a la primera.
            ->assertSeeInOrder([
                'Vistos recientemente',
                '/equipos/'.$ids[4].'"',
                '/equipos/'.$ids[3].'"',
                '/equipos/'.$ids[2].'"',
                '/equipos/'.$ids[1].'"',
            ], false);
    }
}
