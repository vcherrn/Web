<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\CategoryCreator;
use App\Models\Creator;
use App\Models\Prosthes;

class ProsthesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prosthes::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'specifiable_id' => $this->faker->numberBetween(-10000, 10000),
            'specifiable_type' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'category_id' => Category::factory(),
            'creator_id' => Creator::factory(),
            'status' => $this->faker->boolean(),
            'article' => $this->faker->regexify('[A-Za-z0-9]{40}'),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'photos' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 999999.99),
            'year_of_creating' => $this->faker->numberBetween(-10000, 10000),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'category_creator_id' => CategoryCreator::factory(),
        ];
    }
}
