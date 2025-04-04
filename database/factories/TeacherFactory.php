<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('##########'),
            'user_id' => User::factory()->state(['role' => 'teacher'])->create()->id,
        ];
    }
}