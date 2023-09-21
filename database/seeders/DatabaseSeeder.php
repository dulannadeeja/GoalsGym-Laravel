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

        $this->call([
            UserRoleSeeder::class,
            UserSeeder::class,
            ClassTypeSeeder::class,
            ScheduledClassSeeder::class,
        ]);
    }
}
