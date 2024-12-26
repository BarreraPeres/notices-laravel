<?php

namespace Database\Seeders;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::all()
            ->map(function ($user) {
                Notice::factory()->create([
                    "author" => $user->id
                ]);
            });
    }
}
