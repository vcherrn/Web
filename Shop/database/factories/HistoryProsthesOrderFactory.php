<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HistoryOrder;
use App\Models\HistoryOrderProsthes;
use App\Models\HistoryProsthesOrder;
use App\Models\Prosthe;

class HistoryProsthesOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HistoryProsthesOrder::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => HistoryOrder::factory(),
            'prosthes_id' => Prosthe::factory(),
            'count' => $this->faker->numberBetween(-10000, 10000),
            'created_at' => $this->faker->dateTime(),
            'history_order_prosthes_id' => HistoryOrderProsthes::factory(),
        ];
    }
}
