<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ClassType;
use App\Models\ScheduledClass;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Use the UserRoleFactory to seed the roles table
        UserRole::factory()->count(3)->create();

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        ClassType::factory()->count(10)->create();
        ScheduledClass::factory()->count(50)->create();
    }
}
