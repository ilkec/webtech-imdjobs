<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'email_verified_at' => now(),
            'description' => $this->faker->realText(200),
            'phone_number' => $this->faker->phoneNumber,
            'city' => $this->faker->city,
            'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'language' => $this->faker->languageCode,
            'account_type' => 0,
            'password' => $this->faker->password,
            'remember_token' => $this->faker->uuid


        ];
    }
}
