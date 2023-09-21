<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduledClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => $this->faker->numberBetween(13, 23),
            'class_type_id' => $this->faker->numberBetween(1, 13),
            'started_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
