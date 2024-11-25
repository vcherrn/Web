<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProsthes;
use App\Models\Prosthes;
use App\Models\ProsthesOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProsthesOrderController
 */
final class ProsthesOrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $prosthesOrders = ProsthesOrder::factory()->count(3)->create();

        $response = $this->get(route('prosthes-order.index'));

        $response->assertOk();
        $response->assertViewIs('prosthesOrder.index');
        $response->assertViewHas('prosthesOrders');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('prosthes-order.create'));

        $response->assertOk();
        $response->assertViewIs('prosthesOrder.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProsthesOrderController::class,
            'store',
            \App\Http\Requests\ProsthesOrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $order = Order::factory()->create();
        $prosthes = Prosthes::factory()->create();
        $count = $this->faker->numberBetween(-10000, 10000);
        $order_prosthes = OrderProsthes::factory()->create();

        $response = $this->post(route('prosthes-order.store'), [
            'order_id' => $order->id,
            'prosthes_id' => $prosthes->id,
            'count' => $count,
            'order_prosthes_id' => $order_prosthes->id,
        ]);

        $prosthesOrders = ProsthesOrder::query()
            ->where('order_id', $order->id)
            ->where('prosthes_id', $prosthes->id)
            ->where('count', $count)
            ->where('order_prosthes_id', $order_prosthes->id)
            ->get();
        $this->assertCount(1, $prosthesOrders);
        $prosthesOrder = $prosthesOrders->first();

        $response->assertRedirect(route('prosthes-order.index'));
        $response->assertSessionHas('prosthesOrder.id', $prosthesOrder->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $prosthesOrder = ProsthesOrder::factory()->create();

        $response = $this->get(route('prosthes-order.show', $prosthesOrder));

        $response->assertOk();
        $response->assertViewIs('prosthesOrder.show');
        $response->assertViewHas('prosthesOrder');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $prosthesOrder = ProsthesOrder::factory()->create();

        $response = $this->get(route('prosthes-order.edit', $prosthesOrder));

        $response->assertOk();
        $response->assertViewIs('prosthesOrder.edit');
        $response->assertViewHas('prosthesOrder');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProsthesOrderController::class,
            'update',
            \App\Http\Requests\ProsthesOrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $prosthesOrder = ProsthesOrder::factory()->create();
        $order = Order::factory()->create();
        $prosthes = Prosthes::factory()->create();
        $count = $this->faker->numberBetween(-10000, 10000);
        $order_prosthes = OrderProsthes::factory()->create();

        $response = $this->put(route('prosthes-order.update', $prosthesOrder), [
            'order_id' => $order->id,
            'prosthes_id' => $prosthes->id,
            'count' => $count,
            'order_prosthes_id' => $order_prosthes->id,
        ]);

        $prosthesOrder->refresh();

        $response->assertRedirect(route('prosthes-order.index'));
        $response->assertSessionHas('prosthesOrder.id', $prosthesOrder->id);

        $this->assertEquals($order->id, $prosthesOrder->order_id);
        $this->assertEquals($prosthes->id, $prosthesOrder->prosthes_id);
        $this->assertEquals($count, $prosthesOrder->count);
        $this->assertEquals($order_prosthes->id, $prosthesOrder->order_prosthes_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $prosthesOrder = ProsthesOrder::factory()->create();

        $response = $this->delete(route('prosthes-order.destroy', $prosthesOrder));

        $response->assertRedirect(route('prosthes-order.index'));

        $this->assertModelMissing($prosthesOrder);
    }
}
