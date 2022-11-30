<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\Proxy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Proxy>
 */
class ProxyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'provider_id' => Provider::firstOrFail()->id,
            'ip' => fake()->ipv4,
            'port' => fake()->numberBetween(0, 65535),
            'login' => fake()->userName,
            'password' => fake()->shuffleString('pLanUMEnDebE'),
        ];
    }
}
