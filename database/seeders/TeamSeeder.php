<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::factory(10)
            ->has(Player::factory(11), 'players')
            ->create()
            ->each(function (Team $team) {
                $fake_image = $this->generateFakeImage();
                $team->addMediaFromDisk($fake_image, 'local')->toMediaCollection();
            });

    }

    private function generateFakeImage(): string
    {
        Storage::disk('local')->copy('fake/fake.svg', 'fake/fake-1.svg');

        return 'fake/fake-1.svg';
    }
}
