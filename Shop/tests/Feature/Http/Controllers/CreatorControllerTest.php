<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Creator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CreatorController
 */
final class CreatorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $creators = Creator::factory()->count(3)->create();

        $response = $this->get(route('creator.index'));

        $response->assertOk();
        $response->assertViewIs('creator.index');
        $response->assertViewHas('creators');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('creator.create'));

        $response->assertOk();
        $response->assertViewIs('creator.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CreatorController::class,
            'store',
            \App\Http\Requests\CreatorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('creator.store'));

        $response->assertRedirect(route('creator.index'));
        $response->assertSessionHas('creator.id', $creator->id);

        $this->assertDatabaseHas(creators, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $creator = Creator::factory()->create();

        $response = $this->get(route('creator.show', $creator));

        $response->assertOk();
        $response->assertViewIs('creator.show');
        $response->assertViewHas('creator');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $creator = Creator::factory()->create();

        $response = $this->get(route('creator.edit', $creator));

        $response->assertOk();
        $response->assertViewIs('creator.edit');
        $response->assertViewHas('creator');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CreatorController::class,
            'update',
            \App\Http\Requests\CreatorUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $creator = Creator::factory()->create();

        $response = $this->put(route('creator.update', $creator));

        $creator->refresh();

        $response->assertRedirect(route('creator.index'));
        $response->assertSessionHas('creator.id', $creator->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $creator = Creator::factory()->create();

        $response = $this->delete(route('creator.destroy', $creator));

        $response->assertRedirect(route('creator.index'));

        $this->assertModelMissing($creator);
    }
}
