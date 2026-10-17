<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Controllers\TeamController;
use App\Http\Requests\StoreTeamRequest;
use ReflectionMethod;
use Tests\TestCase;

/**
 * Ejercicio 07 · la validación, en su sitio y con la regla que no existe.
 */
final class ValidationTest extends TestCase
{
    /**
     * El controlador ya no valida: recibe un StoreTeamRequest y se fía. Se
     * comprueba por la firma del método y no por el texto del fichero, porque
     * lo que importa es quién valida, no cómo esté escrito.
     */
    public function test_the_validation_lives_in_a_form_request(): void
    {
        $store = new ReflectionMethod(TeamController::class, 'store');
        $type  = $store->getParameters()[0]->getType();

        self::assertNotNull($type, 'store() no declara el tipo de su petición.');
        self::assertSame(
            StoreTeamRequest::class,
            (string) $type,
            'store() no recibe el Form Request, así que la validación sigue en el controlador.',
        );

        // Y para que no quede duda: ni una llamada a validate() en el controlador.
        $source = (string) file_get_contents((string) $store->getFileName());

        self::assertStringNotContainsString('->validate(', $source);
    }

    /**
     * El límite de abajo es un hecho del club; el de arriba depende de cuándo
     * se ejecute el código, y por eso ninguna regla de serie servía.
     */
    public function test_the_season_rule_rejects_1930_and_accepts_1931(): void
    {
        $base = ['name' => 'Histórico', 'category' => 'Sénior', 'coach' => 'Quien sea'];

        $this->post('/equipos', $base + ['season' => '1930'])
            ->assertInvalid(['season']);

        $this->post('/equipos', $base + ['season' => '1931'])
            ->assertValid();

        // Y el de arriba se mueve solo: el año que viene vale, el siguiente no.
        $this->post('/equipos', $base + ['season' => (string) ((int) date('Y') + 1)])
            ->assertValid();

        $this->post('/equipos', $base + ['season' => (string) ((int) date('Y') + 2)])
            ->assertInvalid(['season']);
    }
}
