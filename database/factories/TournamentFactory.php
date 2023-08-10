<?php

namespace Database\Factories;

use App\Enums\TournamentType;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tournament>
 */
class TournamentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement(TournamentType::cases()),
            'is_home_away' => $this->faker->boolean
        ];
    }
}
