<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cart;
use App\Models\Prosthes;
use App\Models\User;
use App\Models\UserProsthes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CartController
 */
final class CartControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $carts = Cart::factory()->count(3)->create();

        $response = $this->get(route('cart.index'));

        $response->assertOk();
        $response->assertViewIs('cart.index');
        $response->assertViewHas('carts');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('cart.create'));

        $response->assertOk();
        $response->assertViewIs('cart.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CartController::class,
            'store',
            \App\Http\Requests\CartStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $prosthes = Prosthes::factory()->create();
        $user = User::factory()->create();
        $count = $this->faker->numberBetween(-10000, 10000);
        $user_prosthes = UserProsthes::factory()->create();

        $response = $this->post(route('cart.store'), [
            'prosthes_id' => $prosthes->id,
            'user_id' => $user->id,
            'count' => $count,
            'user_prosthes_id' => $user_prosthes->id,
        ]);

        $carts = Cart::query()
            ->where('prosthes_id', $prosthes->id)
            ->where('user_id', $user->id)
            ->where('count', $count)
            ->where('user_prosthes_id', $user_prosthes->id)
            ->get();
        $this->assertCount(1, $carts);
        $cart = $carts->first();

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('cart.id', $cart->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $cart = Cart::factory()->create();

        $response = $this->get(route('cart.show', $cart));

        $response->assertOk();
        $response->assertViewIs('cart.show');
        $response->assertViewHas('cart');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $cart = Cart::factory()->create();

        $response = $this->get(route('cart.edit', $cart));

        $response->assertOk();
        $response->assertViewIs('cart.edit');
        $response->assertViewHas('cart');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CartController::class,
            'update',
            \App\Http\Requests\CartUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $cart = Cart::factory()->create();
        $prosthes = Prosthes::factory()->create();
        $user = User::factory()->create();
        $count = $this->faker->numberBetween(-10000, 10000);
        $user_prosthes = UserProsthes::factory()->create();

        $response = $this->put(route('cart.update', $cart), [
            'prosthes_id' => $prosthes->id,
            'user_id' => $user->id,
            'count' => $count,
            'user_prosthes_id' => $user_prosthes->id,
        ]);

        $cart->refresh();

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('cart.id', $cart->id);

        $this->assertEquals($prosthes->id, $cart->prosthes_id);
        $this->assertEquals($user->id, $cart->user_id);
        $this->assertEquals($count, $cart->count);
        $this->assertEquals($user_prosthes->id, $cart->user_prosthes_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $cart = Cart::factory()->create();

        $response = $this->delete(route('cart.destroy', $cart));

        $response->assertRedirect(route('cart.index'));

        $this->assertModelMissing($cart);
    }
}
