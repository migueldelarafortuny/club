<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Ejercicio 05 · el catálogo: diez equipos listados, y cada uno con su ficha.
 *
 * No mira nombres concretos: cada alumno escribe sus propios equipos. Lee del
 * listado los enlaces a las fichas y trabaja con esos ids.
 */
final class CatalogTest extends TestCase
{
    /** @return list<int> los ids de las fichas enlazadas desde el listado, sin repetir */
    private function listedIds(): array
    {
        $html = $this->get('/equipos')->assertOk()->getContent();
        preg_match_all('#/equipos/(\d+)"#', (string) $html, $m);

        return array_values(array_unique(array_map('intval', $m[1])));
    }

    public function test_the_catalogue_lists_ten_teams(): void
    {
        self::assertCount(10, $this->listedIds(), 'El listado no enlaza diez fichas.');

        // Y el recuento que pide el enunciado, escrito como cada uno quiera.
        $this->get('/equipos')->assertSeeText('10');
    }

    public function test_a_team_has_its_own_page(): void
    {
        foreach ($this->listedIds() as $id) {
            $this->get('/equipos/'.$id)->assertOk();
        }
    }
}
