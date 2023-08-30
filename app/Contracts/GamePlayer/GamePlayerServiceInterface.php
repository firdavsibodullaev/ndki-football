<?php

namespace App\Contracts\GamePlayer;

use App\DTOs\Game\Start\StartGameDTO;
use App\Models\Game;

interface GamePlayerServiceInterface
{
    public function create(Game $game, StartGameDTO $payload): bool;
}
