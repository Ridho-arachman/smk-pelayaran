<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $role = fake()->randomElement(['admin', 'teacher', 'student']);
        
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => $role,
            'nip' => $role === 'teacher' ? fake()->unique()->numerify('##################') : null,
            'nisn' => $role === 'student' ? fake()->unique()->numerify('##########') : null,
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }
}
