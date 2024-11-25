<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SpecificationFoot;

class SpecificationFootFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecificationFoot::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'product_type' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'amputation_rate' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'activity_level' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'max_weight' => $this->faker->numberBetween(-10000, 10000),
            'type_of_side' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'size_of_prosthes' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'weight' => $this->faker->numberBetween(-10000, 10000),
            'foot_shape' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'color' => $this->faker->regexify('[A-Za-z0-9]{60}'),
            'height' => $this->faker->numberBetween(-10000, 10000),
            'material' => $this->faker->regexify('[A-Za-z0-9]{60}'),
        ];
    }
}
