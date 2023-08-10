<?php

namespace Database\Seeders;

use App\Models\Season;
use App\Models\Tournament;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tournament::factory(2)
            ->has(Season::factory(2), 'seasons')
            ->create();
    }
}
