<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Prosthes;
use App\Models\User;
use App\Models\UserProsthes;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WishlistController
 */
final class WishlistControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $wishlists = Wishlist::factory()->count(3)->create();

        $response = $this->get(route('wishlist.index'));

        $response->assertOk();
        $response->assertViewIs('wishlist.index');
        $response->assertViewHas('wishlists');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('wishlist.create'));

        $response->assertOk();
        $response->assertViewIs('wishlist.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WishlistController::class,
            'store',
            \App\Http\Requests\WishlistStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $prosthes = Prosthes::factory()->create();
        $user = User::factory()->create();
        $user_prosthes = UserProsthes::factory()->create();

        $response = $this->post(route('wishlist.store'), [
            'prosthes_id' => $prosthes->id,
            'user_id' => $user->id,
            'user_prosthes_id' => $user_prosthes->id,
        ]);

        $wishlists = Wishlist::query()
            ->where('prosthes_id', $prosthes->id)
            ->where('user_id', $user->id)
            ->where('user_prosthes_id', $user_prosthes->id)
            ->get();
        $this->assertCount(1, $wishlists);
        $wishlist = $wishlists->first();

        $response->assertRedirect(route('wishlist.index'));
        $response->assertSessionHas('wishlist.id', $wishlist->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $wishlist = Wishlist::factory()->create();

        $response = $this->get(route('wishlist.show', $wishlist));

        $response->assertOk();
        $response->assertViewIs('wishlist.show');
        $response->assertViewHas('wishlist');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $wishlist = Wishlist::factory()->create();

        $response = $this->get(route('wishlist.edit', $wishlist));

        $response->assertOk();
        $response->assertViewIs('wishlist.edit');
        $response->assertViewHas('wishlist');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WishlistController::class,
            'update',
            \App\Http\Requests\WishlistUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $wishlist = Wishlist::factory()->create();
        $prosthes = Prosthes::factory()->create();
        $user = User::factory()->create();
        $user_prosthes = UserProsthes::factory()->create();

        $response = $this->put(route('wishlist.update', $wishlist), [
            'prosthes_id' => $prosthes->id,
            'user_id' => $user->id,
            'user_prosthes_id' => $user_prosthes->id,
        ]);

        $wishlist->refresh();

        $response->assertRedirect(route('wishlist.index'));
        $response->assertSessionHas('wishlist.id', $wishlist->id);

        $this->assertEquals($prosthes->id, $wishlist->prosthes_id);
        $this->assertEquals($user->id, $wishlist->user_id);
        $this->assertEquals($user_prosthes->id, $wishlist->user_prosthes_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $wishlist = Wishlist::factory()->create();

        $response = $this->delete(route('wishlist.destroy', $wishlist));

        $response->assertRedirect(route('wishlist.index'));

        $this->assertModelMissing($wishlist);
    }
}
