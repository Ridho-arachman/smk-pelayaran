<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'gender' => 'male',
            'is_active' => true,
        ]);

        // Create 10 teachers with their users
        User::factory()
            ->count(10)
            ->state(['role' => 'teacher'])
            ->has(Teacher::factory())
            ->create();

        // Create 50 students with their users
        User::factory()
            ->count(50)
            ->state(['role' => 'student'])
            ->has(Student::factory())
            ->create();
    }
}
