<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(100),
            'user_type' => fake()->randomElement(['all', 'students', 'teachers', 'financial']),
            'procedure' => fake()->word(),
            'description' => fake()->text(150),
            'brief_description' => fake()->text(100),
            'author' => fake()->name(),
            'generate_pop_up' => fake()->boolean(),
            'pop_up_expiration' => fake()->dateTimeBetween('now', '+30 days'),
            'pop_up_image' => fake()->imageUrl(),
            'notice_active' => fake()->boolean(),
            'date_inactivation' => fake()->dateTimeBetween('-1 year', 'now'),
            'motive_inactivation' => fake()->text(100),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => now(),
        ];
    }
}
