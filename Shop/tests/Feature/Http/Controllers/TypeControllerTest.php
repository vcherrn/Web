<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TypeController
 */
final class TypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $types = Type::factory()->count(3)->create();

        $response = $this->get(route('type.index'));

        $response->assertOk();
        $response->assertViewIs('type.index');
        $response->assertViewHas('types');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('type.create'));

        $response->assertOk();
        $response->assertViewIs('type.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TypeController::class,
            'store',
            \App\Http\Requests\TypeStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('type.store'));

        $response->assertRedirect(route('type.index'));
        $response->assertSessionHas('type.id', $type->id);

        $this->assertDatabaseHas(types, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $type = Type::factory()->create();

        $response = $this->get(route('type.show', $type));

        $response->assertOk();
        $response->assertViewIs('type.show');
        $response->assertViewHas('type');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $type = Type::factory()->create();

        $response = $this->get(route('type.edit', $type));

        $response->assertOk();
        $response->assertViewIs('type.edit');
        $response->assertViewHas('type');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TypeController::class,
            'update',
            \App\Http\Requests\TypeUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $type = Type::factory()->create();

        $response = $this->put(route('type.update', $type));

        $type->refresh();

        $response->assertRedirect(route('type.index'));
        $response->assertSessionHas('type.id', $type->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $type = Type::factory()->create();

        $response = $this->delete(route('type.destroy', $type));

        $response->assertRedirect(route('type.index'));

        $this->assertModelMissing($type);
    }
}
