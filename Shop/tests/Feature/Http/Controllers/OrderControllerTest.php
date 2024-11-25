<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('order.index'));

        $response->assertOk();
        $response->assertViewIs('order.index');
        $response->assertViewHas('orders');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('order.create'));

        $response->assertOk();
        $response->assertViewIs('order.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $name = $this->faker->name();
        $surname = $this->faker->word();
        $patronymic = $this->faker->word();
        $country = $this->faker->country();
        $town = $this->faker->word();
        $area = $this->faker->word();
        $street = $this->faker->streetName();
        $house = $this->faker->word();
        $apartment = $this->faker->word();

        $response = $this->post(route('order.store'), [
            'user_id' => $user->id,
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'country' => $country,
            'town' => $town,
            'area' => $area,
            'street' => $street,
            'house' => $house,
            'apartment' => $apartment,
        ]);

        $orders = Order::query()
            ->where('user_id', $user->id)
            ->where('name', $name)
            ->where('surname', $surname)
            ->where('patronymic', $patronymic)
            ->where('country', $country)
            ->where('town', $town)
            ->where('area', $area)
            ->where('street', $street)
            ->where('house', $house)
            ->where('apartment', $apartment)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertRedirect(route('order.index'));
        $response->assertSessionHas('order.id', $order->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('order.show', $order));

        $response->assertOk();
        $response->assertViewIs('order.show');
        $response->assertViewHas('order');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('order.edit', $order));

        $response->assertOk();
        $response->assertViewIs('order.edit');
        $response->assertViewHas('order');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'update',
            \App\Http\Requests\OrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $name = $this->faker->name();
        $surname = $this->faker->word();
        $patronymic = $this->faker->word();
        $country = $this->faker->country();
        $town = $this->faker->word();
        $area = $this->faker->word();
        $street = $this->faker->streetName();
        $house = $this->faker->word();
        $apartment = $this->faker->word();

        $response = $this->put(route('order.update', $order), [
            'user_id' => $user->id,
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'country' => $country,
            'town' => $town,
            'area' => $area,
            'street' => $street,
            'house' => $house,
            'apartment' => $apartment,
        ]);

        $order->refresh();

        $response->assertRedirect(route('order.index'));
        $response->assertSessionHas('order.id', $order->id);

        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($name, $order->name);
        $this->assertEquals($surname, $order->surname);
        $this->assertEquals($patronymic, $order->patronymic);
        $this->assertEquals($country, $order->country);
        $this->assertEquals($town, $order->town);
        $this->assertEquals($area, $order->area);
        $this->assertEquals($street, $order->street);
        $this->assertEquals($house, $order->house);
        $this->assertEquals($apartment, $order->apartment);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('order.destroy', $order));

        $response->assertRedirect(route('order.index'));

        $this->assertModelMissing($order);
    }
}
