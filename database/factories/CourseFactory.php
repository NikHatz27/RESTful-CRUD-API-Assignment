<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Courses\Models\Course;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->realText(150),
            'status' => $this->faker->randomElement(['Published', 'Pending']),
            'is_premium' => $this->faker->boolean,
            'created_at' => now(),
        ];
    }
}
