<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::all()
        //     ->each(function (User $user) {
        //         Notification::factory(10)
        //     });
        Notification::factory()
            ->count(30)
            ->create();
    }
}
