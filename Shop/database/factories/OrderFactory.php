<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'patronymic' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'country' => $this->faker->country(),
            'town' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'area' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'street' => $this->faker->streetName(),
            'house' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'apartment' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'telephone_number' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'user_email' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'message_text' => $this->faker->text(),
            'order_sum' => $this->faker->randomFloat(2, 0, 999999.99),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
