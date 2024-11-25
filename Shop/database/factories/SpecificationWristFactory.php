<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SpecificationWrist;

class SpecificationWristFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecificationWrist::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'product_type' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'type_of_side' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'arm_size' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'voltage' => $this->faker->randomFloat(2, 0, 999999.99),
            'temperature' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'opening_width' => $this->faker->numberBetween(-10000, 10000),
            'gripping_power' => $this->faker->numberBetween(-10000, 10000),
            'gripping_speed' => $this->faker->numberBetween(-10000, 10000),
            'weight' => $this->faker->numberBetween(-10000, 10000),
            'color' => $this->faker->regexify('[A-Za-z0-9]{60}'),
            'material' => $this->faker->regexify('[A-Za-z0-9]{60}'),
        ];
    }
}
