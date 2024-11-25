<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Characteristic;
use App\Models\CharacteristicUser;
use App\Models\User;
use App\Models\UserCharacterisctic;

class UserCharacteriscticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserCharacterisctic::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'characteristic_id' => Characteristic::factory(),
            'characteristic_user_id' => CharacteristicUser::factory(),
        ];
    }
}
