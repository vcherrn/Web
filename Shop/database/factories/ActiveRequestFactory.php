<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ActiveRequest;
use App\Models\RequestType;
use App\Models\RequestTypeUser;
use App\Models\User;

class ActiveRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActiveRequest::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'request_id' => RequestType::factory(),
            'request_status' => $this->faker->boolean(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'patronymic' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'country' => $this->faker->country(),
            'town' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'telephone_number' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'user_email' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'message_text' => $this->faker->text(),
            'created_at' => $this->faker->dateTime(),
            'request_type_user_id' => RequestTypeUser::factory(),
        ];
    }
}
