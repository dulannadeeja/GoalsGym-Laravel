<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'member',
            'email' => 'member@example.com',
            'role_id' => 3,
        ]);
        User::factory(10)->create();
        User::factory()->create([
            'name' => 'instructor',
            'email' => 'instructor@example.com',
            'role_id' => 2,
        ]);
        user::factory()->count(10)->create([
            'role_id' => 2
        ]);
    }
}
