<?php

namespace Database\Factories;

use App\Models\Reviews;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reviews::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'internship_title' => $this->faker->jobTitle,
            'review' => $this->faker->realText(148),
            'score' => $this->faker->numberBetween($min = 1, $max = 10),
            'mentoring' => 1,
            'Users_id' => 5,
            'company_id' => 3
        ];
    }
}
