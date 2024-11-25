<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\SpecificationKnee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpecificationKneeController
 */
final class SpecificationKneeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $specificationKnees = SpecificationKnee::factory()->count(3)->create();

        $response = $this->get(route('specification-knee.index'));

        $response->assertOk();
        $response->assertViewIs('specificationKnee.index');
        $response->assertViewHas('specificationKnees');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('specification-knee.create'));

        $response->assertOk();
        $response->assertViewIs('specificationKnee.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationKneeController::class,
            'store',
            \App\Http\Requests\SpecificationKneeStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route('specification-knee.store'), [
            'category_id' => $category->id,
        ]);

        $specificationKnees = SpecificationKnee::query()
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $specificationKnees);
        $specificationKnee = $specificationKnees->first();

        $response->assertRedirect(route('specification-knee.index'));
        $response->assertSessionHas('specificationKnee.id', $specificationKnee->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $specificationKnee = SpecificationKnee::factory()->create();

        $response = $this->get(route('specification-knee.show', $specificationKnee));

        $response->assertOk();
        $response->assertViewIs('specificationKnee.show');
        $response->assertViewHas('specificationKnee');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $specificationKnee = SpecificationKnee::factory()->create();

        $response = $this->get(route('specification-knee.edit', $specificationKnee));

        $response->assertOk();
        $response->assertViewIs('specificationKnee.edit');
        $response->assertViewHas('specificationKnee');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpecificationKneeController::class,
            'update',
            \App\Http\Requests\SpecificationKneeUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $specificationKnee = SpecificationKnee::factory()->create();
        $category = Category::factory()->create();

        $response = $this->put(route('specification-knee.update', $specificationKnee), [
            'category_id' => $category->id,
        ]);

        $specificationKnee->refresh();

        $response->assertRedirect(route('specification-knee.index'));
        $response->assertSessionHas('specificationKnee.id', $specificationKnee->id);

        $this->assertEquals($category->id, $specificationKnee->category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $specificationKnee = SpecificationKnee::factory()->create();

        $response = $this->delete(route('specification-knee.destroy', $specificationKnee));

        $response->assertRedirect(route('specification-knee.index'));

        $this->assertModelMissing($specificationKnee);
    }
}
