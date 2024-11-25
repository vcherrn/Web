<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Photo;
use App\Models\Prosthesis;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'prosthes_id' => Prosthesis::factory(),
            'path' => $this->faker->text(),
        ];
    }
}
