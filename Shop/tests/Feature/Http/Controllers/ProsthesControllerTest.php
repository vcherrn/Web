<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryCreator;
use App\Models\Creator;
use App\Models\Prosthe;
use App\Models\Prosthes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProsthesController
 */
final class ProsthesControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $prosthes = Prosthes::factory()->count(3)->create();

        $response = $this->get(route('prosthe.index'));

        $response->assertOk();
        $response->assertViewIs('prosthe.index');
        $response->assertViewHas('prosthes');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('prosthe.create'));

        $response->assertOk();
        $response->assertViewIs('prosthe.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProsthesController::class,
            'store',
            \App\Http\Requests\ProsthesStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $specifiable_id = $this->faker->numberBetween(-10000, 10000);
        $specifiable_type = $this->faker->word();
        $category = Category::factory()->create();
        $creator = Creator::factory()->create();
        $status = $this->faker->boolean();
        $category_creator = CategoryCreator::factory()->create();

        $response = $this->post(route('prosthe.store'), [
            'specifiable_id' => $specifiable_id,
            'specifiable_type' => $specifiable_type,
            'category_id' => $category->id,
            'creator_id' => $creator->id,
            'status' => $status,
            'category_creator_id' => $category_creator->id,
        ]);

        $prosthes = Prosthe::query()
            ->where('specifiable_id', $specifiable_id)
            ->where('specifiable_type', $specifiable_type)
            ->where('category_id', $category->id)
            ->where('creator_id', $creator->id)
            ->where('status', $status)
            ->where('category_creator_id', $category_creator->id)
            ->get();
        $this->assertCount(1, $prosthes);
        $prosthe = $prosthes->first();

        $response->assertRedirect(route('prosthe.index'));
        $response->assertSessionHas('prosthe.id', $prosthe->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $prosthe = Prosthes::factory()->create();

        $response = $this->get(route('prosthe.show', $prosthe));

        $response->assertOk();
        $response->assertViewIs('prosthe.show');
        $response->assertViewHas('prosthe');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $prosthe = Prosthes::factory()->create();

        $response = $this->get(route('prosthe.edit', $prosthe));

        $response->assertOk();
        $response->assertViewIs('prosthe.edit');
        $response->assertViewHas('prosthe');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProsthesController::class,
            'update',
            \App\Http\Requests\ProsthesUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $prosthe = Prosthes::factory()->create();
        $specifiable_id = $this->faker->numberBetween(-10000, 10000);
        $specifiable_type = $this->faker->word();
        $category = Category::factory()->create();
        $creator = Creator::factory()->create();
        $status = $this->faker->boolean();
        $category_creator = CategoryCreator::factory()->create();

        $response = $this->put(route('prosthe.update', $prosthe), [
            'specifiable_id' => $specifiable_id,
            'specifiable_type' => $specifiable_type,
            'category_id' => $category->id,
            'creator_id' => $creator->id,
            'status' => $status,
            'category_creator_id' => $category_creator->id,
        ]);

        $prosthe->refresh();

        $response->assertRedirect(route('prosthe.index'));
        $response->assertSessionHas('prosthe.id', $prosthe->id);

        $this->assertEquals($specifiable_id, $prosthe->specifiable_id);
        $this->assertEquals($specifiable_type, $prosthe->specifiable_type);
        $this->assertEquals($category->id, $prosthe->category_id);
        $this->assertEquals($creator->id, $prosthe->creator_id);
        $this->assertEquals($status, $prosthe->status);
        $this->assertEquals($category_creator->id, $prosthe->category_creator_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $prosthe = Prosthes::factory()->create();
        $prosthe = Prosthe::factory()->create();

        $response = $this->delete(route('prosthe.destroy', $prosthe));

        $response->assertRedirect(route('prosthe.index'));

        $this->assertModelMissing($prosthe);
    }
}
