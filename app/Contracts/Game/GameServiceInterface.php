<?php

namespace App\Contracts\Game;

use App\DTOs\Game\GameDTO;
use App\Models\Season;

interface GameServiceInterface
{
    public function create(Season $season, GameDTO $payload): bool;
}
