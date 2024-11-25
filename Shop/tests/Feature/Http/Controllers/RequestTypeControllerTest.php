<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\RequestType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RequestTypeController
 */
final class RequestTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $requestTypes = RequestType::factory()->count(3)->create();

        $response = $this->get(route('request-type.index'));

        $response->assertOk();
        $response->assertViewIs('requestType.index');
        $response->assertViewHas('requestTypes');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('request-type.create'));

        $response->assertOk();
        $response->assertViewIs('requestType.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RequestTypeController::class,
            'store',
            \App\Http\Requests\RequestTypeStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('request-type.store'));

        $response->assertRedirect(route('request-type.index'));
        $response->assertSessionHas('requestType.id', $requestType->id);

        $this->assertDatabaseHas(requestTypes, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $requestType = RequestType::factory()->create();

        $response = $this->get(route('request-type.show', $requestType));

        $response->assertOk();
        $response->assertViewIs('requestType.show');
        $response->assertViewHas('requestType');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $requestType = RequestType::factory()->create();

        $response = $this->get(route('request-type.edit', $requestType));

        $response->assertOk();
        $response->assertViewIs('requestType.edit');
        $response->assertViewHas('requestType');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RequestTypeController::class,
            'update',
            \App\Http\Requests\RequestTypeUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $requestType = RequestType::factory()->create();

        $response = $this->put(route('request-type.update', $requestType));

        $requestType->refresh();

        $response->assertRedirect(route('request-type.index'));
        $response->assertSessionHas('requestType.id', $requestType->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $requestType = RequestType::factory()->create();

        $response = $this->delete(route('request-type.destroy', $requestType));

        $response->assertRedirect(route('request-type.index'));

        $this->assertModelMissing($requestType);
    }
}
