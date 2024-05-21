<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 3, // Asumsi menggunakan user dengan ID 1
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->randomElement(['Personal', 'Work']),
            'status' => $this->faker->randomElement(['Pending', 'Completed']),
            'due_date' => $this->faker->date(),
        ];
    }
}
