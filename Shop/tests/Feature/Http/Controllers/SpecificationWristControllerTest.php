<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\SpecificationWrist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpecificationWristController
 */
final class SpecificationWristControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $specificationWrists = SpecificationWrist::factory()->count(3)->create();

        $response = $this->get(route('specification-wrist.index'));

        $response->assertOk();
        $response->assertViewIs('specificationWrist.index');
        $response->assertViewHas('specificationWrists');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('specification-wrist.create'));

        $response->assertOk();
        $response->assertViewIs('specificationWrist.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationWristController::class,
            'store',
            \App\Http\Requests\SpecificationWristStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route('specification-wrist.store'), [
            'category_id' => $category->id,
        ]);

        $specificationWrists = SpecificationWrist::query()
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $specificationWrists);
        $specificationWrist = $specificationWrists->first();

        $response->assertRedirect(route('specification-wrist.index'));
        $response->assertSessionHas('specificationWrist.id', $specificationWrist->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $specificationWrist = SpecificationWrist::factory()->create();

        $response = $this->get(route('specification-wrist.show', $specificationWrist));

        $response->assertOk();
        $response->assertViewIs('specificationWrist.show');
        $response->assertViewHas('specificationWrist');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $specificationWrist = SpecificationWrist::factory()->create();

        $response = $this->get(route('specification-wrist.edit', $specificationWrist));

        $response->assertOk();
        $response->assertViewIs('specificationWrist.edit');
        $response->assertViewHas('specificationWrist');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationWristController::class,
            'update',
            \App\Http\Requests\SpecificationWristUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $specificationWrist = SpecificationWrist::factory()->create();
        $category = Category::factory()->create();

        $response = $this->put(route('specification-wrist.update', $specificationWrist), [
            'category_id' => $category->id,
        ]);

        $specificationWrist->refresh();

        $response->assertRedirect(route('specification-wrist.index'));
        $response->assertSessionHas('specificationWrist.id', $specificationWrist->id);

        $this->assertEquals($category->id, $specificationWrist->category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $specificationWrist = SpecificationWrist::factory()->create();

        $response = $this->delete(route('specification-wrist.destroy', $specificationWrist));

        $response->assertRedirect(route('specification-wrist.index'));

        $this->assertModelMissing($specificationWrist);
    }
}
