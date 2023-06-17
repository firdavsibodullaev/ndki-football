<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Season>
 */
class SeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->date();

        return [
            'name' => $this->faker->word,
            'started_at' => Carbon::createFromFormat('Y-m-d', $date),
            'finished_at' => Carbon::createFromFormat('Y-m-d', $date)->addYear(),
        ];
    }
}