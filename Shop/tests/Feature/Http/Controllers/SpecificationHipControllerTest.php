<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\SpecificationHip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpecificationHipController
 */
final class SpecificationHipControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $specificationHips = SpecificationHip::factory()->count(3)->create();

        $response = $this->get(route('specification-hip.index'));

        $response->assertOk();
        $response->assertViewIs('specificationHip.index');
        $response->assertViewHas('specificationHips');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('specification-hip.create'));

        $response->assertOk();
        $response->assertViewIs('specificationHip.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationHipController::class,
            'store',
            \App\Http\Requests\SpecificationHipStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route('specification-hip.store'), [
            'category_id' => $category->id,
        ]);

        $specificationHips = SpecificationHip::query()
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $specificationHips);
        $specificationHip = $specificationHips->first();

        $response->assertRedirect(route('specification-hip.index'));
        $response->assertSessionHas('specificationHip.id', $specificationHip->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $specificationHip = SpecificationHip::factory()->create();

        $response = $this->get(route('specification-hip.show', $specificationHip));

        $response->assertOk();
        $response->assertViewIs('specificationHip.show');
        $response->assertViewHas('specificationHip');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $specificationHip = SpecificationHip::factory()->create();

        $response = $this->get(route('specification-hip.edit', $specificationHip));

        $response->assertOk();
        $response->assertViewIs('specificationHip.edit');
        $response->assertViewHas('specificationHip');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationHipController::class,
            'update',
            \App\Http\Requests\SpecificationHipUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $specificationHip = SpecificationHip::factory()->create();
        $category = Category::factory()->create();

        $response = $this->put(route('specification-hip.update', $specificationHip), [
            'category_id' => $category->id,
        ]);

        $specificationHip->refresh();

        $response->assertRedirect(route('specification-hip.index'));
        $response->assertSessionHas('specificationHip.id', $specificationHip->id);

        $this->assertEquals($category->id, $specificationHip->category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $specificationHip = SpecificationHip::factory()->create();

        $response = $this->delete(route('specification-hip.destroy', $specificationHip));

        $response->assertRedirect(route('specification-hip.index'));

        $this->assertModelMissing($specificationHip);
    }
}
