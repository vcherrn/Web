<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HistoryOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HistoryOrderController
 */
final class HistoryOrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $historyOrders = HistoryOrder::factory()->count(3)->create();

        $response = $this->get(route('history-order.index'));

        $response->assertOk();
        $response->assertViewIs('historyOrder.index');
        $response->assertViewHas('historyOrders');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('history-order.create'));

        $response->assertOk();
        $response->assertViewIs('historyOrder.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HistoryOrderController::class,
            'store',
            \App\Http\Requests\HistoryOrderStoreRequest::class
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

        $response = $this->post(route('history-order.store'), [
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

        $historyOrders = HistoryOrder::query()
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
        $this->assertCount(1, $historyOrders);
        $historyOrder = $historyOrders->first();

        $response->assertRedirect(route('history-order.index'));
        $response->assertSessionHas('historyOrder.id', $historyOrder->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $historyOrder = HistoryOrder::factory()->create();

        $response = $this->get(route('history-order.show', $historyOrder));

        $response->assertOk();
        $response->assertViewIs('historyOrder.show');
        $response->assertViewHas('historyOrder');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $historyOrder = HistoryOrder::factory()->create();

        $response = $this->get(route('history-order.edit', $historyOrder));

        $response->assertOk();
        $response->assertViewIs('historyOrder.edit');
        $response->assertViewHas('historyOrder');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HistoryOrderController::class,
            'update',
            \App\Http\Requests\HistoryOrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $historyOrder = HistoryOrder::factory()->create();
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

        $response = $this->put(route('history-order.update', $historyOrder), [
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

        $historyOrder->refresh();

        $response->assertRedirect(route('history-order.index'));
        $response->assertSessionHas('historyOrder.id', $historyOrder->id);

        $this->assertEquals($user->id, $historyOrder->user_id);
        $this->assertEquals($name, $historyOrder->name);
        $this->assertEquals($surname, $historyOrder->surname);
        $this->assertEquals($patronymic, $historyOrder->patronymic);
        $this->assertEquals($country, $historyOrder->country);
        $this->assertEquals($town, $historyOrder->town);
        $this->assertEquals($area, $historyOrder->area);
        $this->assertEquals($street, $historyOrder->street);
        $this->assertEquals($house, $historyOrder->house);
        $this->assertEquals($apartment, $historyOrder->apartment);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $historyOrder = HistoryOrder::factory()->create();

        $response = $this->delete(route('history-order.destroy', $historyOrder));

        $response->assertRedirect(route('history-order.index'));

        $this->assertModelMissing($historyOrder);
    }
}
