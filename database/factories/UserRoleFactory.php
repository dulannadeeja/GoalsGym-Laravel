<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define the roles you want to seed here
        $roles = ['member', 'instructor', 'admin'];

        return [
            'name' => $this->faker->unique()->randomElement($roles),
        ];
    }
}
