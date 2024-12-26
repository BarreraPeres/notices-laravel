<?php

namespace Database\Factories;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_notice' => Notice::factory(),
            'title' => fake()->word(),
            'alias' => fake()->word(),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => now(),
        ];
    }
}
