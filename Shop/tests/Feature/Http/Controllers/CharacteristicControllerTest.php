<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Characteristic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CharacteristicController
 */
final class CharacteristicControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $characteristics = Characteristic::factory()->count(3)->create();

        $response = $this->get(route('characteristic.index'));

        $response->assertOk();
        $response->assertViewIs('characteristic.index');
        $response->assertViewHas('characteristics');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('characteristic.create'));

        $response->assertOk();
        $response->assertViewIs('characteristic.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CharacteristicController::class,
            'store',
            \App\Http\Requests\CharacteristicStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('characteristic.store'));

        $response->assertRedirect(route('characteristic.index'));
        $response->assertSessionHas('characteristic.id', $characteristic->id);

        $this->assertDatabaseHas(characteristics, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $characteristic = Characteristic::factory()->create();

        $response = $this->get(route('characteristic.show', $characteristic));

        $response->assertOk();
        $response->assertViewIs('characteristic.show');
        $response->assertViewHas('characteristic');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $characteristic = Characteristic::factory()->create();

        $response = $this->get(route('characteristic.edit', $characteristic));

        $response->assertOk();
        $response->assertViewIs('characteristic.edit');
        $response->assertViewHas('characteristic');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CharacteristicController::class,
            'update',
            \App\Http\Requests\CharacteristicUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $characteristic = Characteristic::factory()->create();

        $response = $this->put(route('characteristic.update', $characteristic));

        $characteristic->refresh();

        $response->assertRedirect(route('characteristic.index'));
        $response->assertSessionHas('characteristic.id', $characteristic->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $characteristic = Characteristic::factory()->create();

        $response = $this->delete(route('characteristic.destroy', $characteristic));

        $response->assertRedirect(route('characteristic.index'));

        $this->assertModelMissing($characteristic);
    }
}
