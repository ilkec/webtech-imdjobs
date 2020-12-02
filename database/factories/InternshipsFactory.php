<?php

namespace Database\Factories;

use App\Models\Internships;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Internships::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'description' => $this->faker->realText(100),
            'tasks' => $this->faker->realText(150),
            'profile' => $this->faker->realtext(75),
            'active' => 1,
            'companies_id' => 1
        ];
    }
}
