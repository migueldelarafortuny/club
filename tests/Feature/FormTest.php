<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Ejercicio 06 · el formulario. Un alta válida entra, una inválida vuelve
 * campo por campo, y lo que estaba bien escrito no se pierde.
 *
 * Estas tres pruebas son las que el ejercicio 07 **no puede tocar**: cuando la
 * validación se va a un Form Request, el comportamiento tiene que ser el mismo
 * y por eso se comprueba con las mismas pruebas.
 */
final class FormTest extends TestCase
{
    /** @return array<string, string> */
    private function validTeam(): array
    {
        return [
            'name'     => 'Cadete C',
            'category' => 'Cadete',
            'season'   => '2026',
            'coach'    => 'Alba Terrón',
        ];
    }

    public function test_a_valid_team_is_added(): void
    {
        // Solo que se acepte: devolver la vista o redirigir valen las dos en
        // el 06. Exigir la redirección es cosa del 08 (SessionTest).
        $this->post('/equipos', $this->validTeam())->assertValid();

        // Y está de verdad: el listado lo enseña en la siguiente petición.
        $this->get('/equipos')->assertSee('Cadete C');
    }

    public function test_an_invalid_team_is_rejected_field_by_field(): void
    {
        $this->post('/equipos', ['name' => '', 'category' => '', 'season' => '', 'coach' => ''])
            // Los cuatro campos, cada uno con su error: no un «datos
            // incorrectos» genérico.
            ->assertInvalid(['name', 'category', 'season', 'coach']);
    }

    public function test_a_rejected_form_keeps_what_was_typed(): void
    {
        $typed = ['name' => 'Juvenil C', 'coach' => 'Rosa Ibáñez', 'category' => '', 'season' => ''];

        $this->from('/equipos/nuevo')
            ->post('/equipos', $typed)
            ->assertRedirect('/equipos/nuevo');

        // old() devuelve lo que se escribió bien; si esto falla, el alumno se
        // dejó los value="" del formulario.
        $this->get('/equipos/nuevo')
            ->assertSee('Juvenil C')
            ->assertSee('Rosa Ibáñez');
    }
}
