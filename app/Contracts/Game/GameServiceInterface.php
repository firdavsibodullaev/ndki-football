<?php

namespace App\Contracts\Game;

use App\Collections\GamesCollection;
use App\Models\Season;

interface GameServiceInterface
{
    public function create(Season $season, GamesCollection $payload): bool;
}
