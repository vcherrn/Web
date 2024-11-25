<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderProsthes;
use App\Models\Prosthe;
use App\Models\ProsthesOrder;

class ProsthesOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProsthesOrder::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'prosthes_id' => Prosthe::factory(),
            'count' => $this->faker->numberBetween(-10000, 10000),
            'created_at' => $this->faker->dateTime(),
            'order_prosthes_id' => OrderProsthes::factory(),
        ];
    }
}
