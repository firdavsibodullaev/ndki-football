<?php

namespace App\Contracts\Game;

use App\Collections\GamesCollection;
use App\DTOs\Game\Start\StartGameDTO;
use App\Models\Game;
use App\Models\Season;

interface GameServiceInterface
{
    public function create(Season $season, GamesCollection $payload): bool;

    public function start(Season $season, Game $game, StartGameDTO $payload);

    public function finish(Game $game): Game;
}
