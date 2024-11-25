<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SpecificationHip;

class SpecificationHipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecificationHip::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'product_type' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'activity_level' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'max_weight' => $this->faker->numberBetween(-10000, 10000),
            'weight' => $this->faker->numberBetween(-10000, 10000),
            'distal_part_connection' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'proximal_part_connection' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            't_angle' => $this->faker->numberBetween(-10000, 10000),
            'system_height' => $this->faker->numberBetween(-10000, 10000),
            'montage_height' => $this->faker->numberBetween(-10000, 10000),
            'type_of_side' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'material' => $this->faker->regexify('[A-Za-z0-9]{60}'),
        ];
    }
}
