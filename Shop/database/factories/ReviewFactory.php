<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Prosthe;
use App\Models\Review;
use App\Models\User;
use App\Models\UserProsthes;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'prosthes_id' => Prosthe::factory(),
            'user_id' => User::factory(),
            'm_text' => $this->faker->text(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'user_prosthes_id' => UserProsthes::factory(),
        ];
    }
}
