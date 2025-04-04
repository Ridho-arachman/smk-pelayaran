<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nisn' => fake()->unique()->numerify('##########'),
            'nis' => 'S' . date('Y') . fake()->unique()->numerify('####'),
            'user_id' => User::factory()->state(['role' => 'student'])->create()->id,
        ];
    }
}