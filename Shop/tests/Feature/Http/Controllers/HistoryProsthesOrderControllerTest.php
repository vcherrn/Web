<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HistoryOrderProsthes;
use App\Models\HistoryProsthesOrder;
use App\Models\Order;
use App\Models\Prosthes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HistoryProsthesOrderController
 */
final class HistoryProsthesOrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $historyProsthesOrders = HistoryProsthesOrder::factory()->count(3)->create();

        $response = $this->get(route('history-prosthes-order.index'));

        $response->assertOk();
        $response->assertViewIs('historyProsthesOrder.index');
        $response->assertViewHas('historyProsthesOrders');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('history-prosthes-order.create'));

        $response->assertOk();
        $response->assertViewIs('historyProsthesOrder.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HistoryProsthesOrderController::class,
            'store',
            \App\Http\Requests\HistoryProsthesOrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $order = Order::factory()->create();
        $prosthes = Prosthes::factory()->create();
        $count = $this->faker->numberBetween(-10000, 10000);
        $history_order_prosthes = HistoryOrderProsthes::factory()->create();

        $response = $this->post(route('history-prosthes-order.store'), [
            'order_id' => $order->id,
            'prosthes_id' => $prosthes->id,
            'count' => $count,
            'history_order_prosthes_id' => $history_order_prosthes->id,
        ]);

        $historyProsthesOrders = HistoryProsthesOrder::query()
            ->where('order_id', $order->id)
            ->where('prosthes_id', $prosthes->id)
            ->where('count', $count)
            ->where('history_order_prosthes_id', $history_order_prosthes->id)
            ->get();
        $this->assertCount(1, $historyProsthesOrders);
        $historyProsthesOrder = $historyProsthesOrders->first();

        $response->assertRedirect(route('history-prosthes-order.index'));
        $response->assertSessionHas('historyProsthesOrder.id', $historyProsthesOrder->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $historyProsthesOrder = HistoryProsthesOrder::factory()->create();

        $response = $this->get(route('history-prosthes-order.show', $historyProsthesOrder));

        $response->assertOk();
        $response->assertViewIs('historyProsthesOrder.show');
        $response->assertViewHas('historyProsthesOrder');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $historyProsthesOrder = HistoryProsthesOrder::factory()->create();

        $response = $this->get(route('history-prosthes-order.edit', $historyProsthesOrder));

        $response->assertOk();
        $response->assertViewIs('historyProsthesOrder.edit');
        $response->assertViewHas('historyProsthesOrder');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HistoryProsthesOrderController::class,
            'update',
            \App\Http\Requests\HistoryProsthesOrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $historyProsthesOrder = HistoryProsthesOrder::factory()->create();
        $order = Order::factory()->create();
        $prosthes = Prosthes::factory()->create();
        $count = $this->faker->numberBetween(-10000, 10000);
        $history_order_prosthes = HistoryOrderProsthes::factory()->create();

        $response = $this->put(route('history-prosthes-order.update', $historyProsthesOrder), [
            'order_id' => $order->id,
            'prosthes_id' => $prosthes->id,
            'count' => $count,
            'history_order_prosthes_id' => $history_order_prosthes->id,
        ]);

        $historyProsthesOrder->refresh();

        $response->assertRedirect(route('history-prosthes-order.index'));
        $response->assertSessionHas('historyProsthesOrder.id', $historyProsthesOrder->id);

        $this->assertEquals($order->id, $historyProsthesOrder->order_id);
        $this->assertEquals($prosthes->id, $historyProsthesOrder->prosthes_id);
        $this->assertEquals($count, $historyProsthesOrder->count);
        $this->assertEquals($history_order_prosthes->id, $historyProsthesOrder->history_order_prosthes_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $historyProsthesOrder = HistoryProsthesOrder::factory()->create();

        $response = $this->delete(route('history-prosthes-order.destroy', $historyProsthesOrder));

        $response->assertRedirect(route('history-prosthes-order.index'));

        $this->assertModelMissing($historyProsthesOrder);
    }
}
