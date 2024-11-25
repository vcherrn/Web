<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SpecificationKnee;

class SpecificationKneeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecificationKnee::class;

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
            'weight' => $this->faker->numberBetween(-10000, 10000),
            'material' => $this->faker->regexify('[A-Za-z0-9]{60}'),
            'distal_part_connection' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'proximal_part_connection' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'knee_angle' => $this->faker->numberBetween(-10000, 10000),
            'system_height_prox' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'min_system_height_dist' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'max_system_height_dist' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'min_montage_height' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'max_montage_height' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'proximal_montage_height' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'min_dist_montage_height' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'max_dist_montage_height' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
