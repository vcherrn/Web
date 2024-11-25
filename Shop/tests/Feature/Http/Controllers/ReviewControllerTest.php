<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Prosthes;
use App\Models\Review;
use App\Models\User;
use App\Models\UserProsthes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReviewController
 */
final class ReviewControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $reviews = Review::factory()->count(3)->create();

        $response = $this->get(route('review.index'));

        $response->assertOk();
        $response->assertViewIs('review.index');
        $response->assertViewHas('reviews');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('review.create'));

        $response->assertOk();
        $response->assertViewIs('review.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReviewController::class,
            'store',
            \App\Http\Requests\ReviewStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $prosthes = Prosthes::factory()->create();
        $user = User::factory()->create();
        $user_prosthes = UserProsthes::factory()->create();

        $response = $this->post(route('review.store'), [
            'prosthes_id' => $prosthes->id,
            'user_id' => $user->id,
            'user_prosthes_id' => $user_prosthes->id,
        ]);

        $reviews = Review::query()
            ->where('prosthes_id', $prosthes->id)
            ->where('user_id', $user->id)
            ->where('user_prosthes_id', $user_prosthes->id)
            ->get();
        $this->assertCount(1, $reviews);
        $review = $reviews->first();

        $response->assertRedirect(route('review.index'));
        $response->assertSessionHas('review.id', $review->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $review = Review::factory()->create();

        $response = $this->get(route('review.show', $review));

        $response->assertOk();
        $response->assertViewIs('review.show');
        $response->assertViewHas('review');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $review = Review::factory()->create();

        $response = $this->get(route('review.edit', $review));

        $response->assertOk();
        $response->assertViewIs('review.edit');
        $response->assertViewHas('review');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReviewController::class,
            'update',
            \App\Http\Requests\ReviewUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $review = Review::factory()->create();
        $prosthes = Prosthes::factory()->create();
        $user = User::factory()->create();
        $user_prosthes = UserProsthes::factory()->create();

        $response = $this->put(route('review.update', $review), [
            'prosthes_id' => $prosthes->id,
            'user_id' => $user->id,
            'user_prosthes_id' => $user_prosthes->id,
        ]);

        $review->refresh();

        $response->assertRedirect(route('review.index'));
        $response->assertSessionHas('review.id', $review->id);

        $this->assertEquals($prosthes->id, $review->prosthes_id);
        $this->assertEquals($user->id, $review->user_id);
        $this->assertEquals($user_prosthes->id, $review->user_prosthes_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $review = Review::factory()->create();

        $response = $this->delete(route('review.destroy', $review));

        $response->assertRedirect(route('review.index'));

        $this->assertModelMissing($review);
    }
}
