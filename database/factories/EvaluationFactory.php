<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EvaluationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'date' => fake()->dateTimeThisMonth(),
            'type' => fake()->randomElement(['exam', 'homework']),
        ];
    }
}
