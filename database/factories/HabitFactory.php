<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $habits = [
            'Creatina',
            'Correr',
            'Estudar',
            'Academia',
            'Inglês',
            'Ler'];

        return [
            'user_id' => User::factory(),
            'uuid' => fake()->uuid(),
            'title' => fake()->randomElement($habits),
        ];
    }
}
