<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = collect(['M', 'F']);
        $randSex = $sex->random();
        return [
            'name' => Str::random(20),
            'cpf' => Str::random(14),
            'sex' => $randSex,
            'address' => Str::random(50),
            'city_id' => City::factory()->createOne()->id,
        ];
    }
}
