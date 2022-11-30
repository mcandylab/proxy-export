<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\Proxy;
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
        if (! User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'email' => 'test@example.com',
            ]);
        }

        $provider = Provider::factory()->create();

        Proxy::factory(10)->create(['provider_id' => $provider->id]);
    }
}
