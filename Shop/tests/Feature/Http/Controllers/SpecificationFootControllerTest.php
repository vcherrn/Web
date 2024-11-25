<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\SpecificationFoot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpecificationFootController
 */
final class SpecificationFootControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $specificationFeet = SpecificationFoot::factory()->count(3)->create();

        $response = $this->get(route('specification-foot.index'));

        $response->assertOk();
        $response->assertViewIs('specificationFoot.index');
        $response->assertViewHas('specificationFeet');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('specification-foot.create'));

        $response->assertOk();
        $response->assertViewIs('specificationFoot.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationFootController::class,
            'store',
            \App\Http\Requests\SpecificationFootStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route('specification-foot.store'), [
            'category_id' => $category->id,
        ]);

        $specificationFeet = SpecificationFoot::query()
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $specificationFeet);
        $specificationFoot = $specificationFeet->first();

        $response->assertRedirect(route('specification-foot.index'));
        $response->assertSessionHas('specificationFoot.id', $specificationFoot->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $specificationFoot = SpecificationFoot::factory()->create();

        $response = $this->get(route('specification-foot.show', $specificationFoot));

        $response->assertOk();
        $response->assertViewIs('specificationFoot.show');
        $response->assertViewHas('specificationFoot');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $specificationFoot = SpecificationFoot::factory()->create();

        $response = $this->get(route('specification-foot.edit', $specificationFoot));

        $response->assertOk();
        $response->assertViewIs('specificationFoot.edit');
        $response->assertViewHas('specificationFoot');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationFootController::class,
            'update',
            \App\Http\Requests\SpecificationFootUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $specificationFoot = SpecificationFoot::factory()->create();
        $category = Category::factory()->create();

        $response = $this->put(route('specification-foot.update', $specificationFoot), [
            'category_id' => $category->id,
        ]);

        $specificationFoot->refresh();

        $response->assertRedirect(route('specification-foot.index'));
        $response->assertSessionHas('specificationFoot.id', $specificationFoot->id);

        $this->assertEquals($category->id, $specificationFoot->category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $specificationFoot = SpecificationFoot::factory()->create();

        $response = $this->delete(route('specification-foot.destroy', $specificationFoot));

        $response->assertRedirect(route('specification-foot.index'));

        $this->assertModelMissing($specificationFoot);
    }
}
