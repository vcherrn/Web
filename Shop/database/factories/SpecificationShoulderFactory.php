<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SpecificationShoulder;

class SpecificationShoulderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecificationShoulder::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'product_type' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'type_of_side' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'gripping_power' => $this->faker->numberBetween(-10000, 10000),
            'opening_width' => $this->faker->numberBetween(-10000, 10000),
            'voltage' => $this->faker->randomFloat(2, 0, 999999.99),
            'gripping_speed' => $this->faker->randomFloat(2, 0, 999999.99),
            'weight' => $this->faker->randomFloat(2, 0, 999999.99),
            'color' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'material' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
