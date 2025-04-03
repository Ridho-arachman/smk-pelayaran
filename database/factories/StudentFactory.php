<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        static $number = 1;
        
        return [
            'nis' => 'S' . date('Y') . str_pad($number++, 4, '0', STR_PAD_LEFT),
            'nisn' => fake()->unique()->numerify('##########'),
        ];
    }
}