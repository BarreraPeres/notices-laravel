<?php

namespace Database\Seeders;

use App\Models\NotificationUser;
use Illuminate\Database\Seeder;

class NotificationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotificationUser::factory()
            ->count(15)
            ->create();
    }
}
