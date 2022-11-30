<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        if (!User::where("email", "test@example.com")->exists()) {
            User::factory()->create([
                "email" => "test@example.com",
            ]);
        }
    }
}
