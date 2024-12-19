<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationUser>
 */
class NotificationUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(),
            'id_notification' => Notification::factory(),
            'seen' => fake()->boolean(),
            'date_seen' => fake()->dateTimeBetween('-1 year'),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => now(),
        ];
    }
}
