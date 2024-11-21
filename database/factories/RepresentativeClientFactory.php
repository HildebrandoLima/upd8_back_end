<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Representative;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RepresentativeClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'representative_id' => Representative::factory()->createOne()->id,
            'client_id' => Client::factory()->createOne()->id,
        ];
    }
}
