<?php

namespace App\Contracts\Game;

use App\DTOs\Game\SaveScoreDTO;
use App\Models\Game;

interface GameRepositoryInterface
{
    public function insert(array $items): bool;

    public function start(Game $game): Game;

    public function finish(Game $game): Game;

    public function saveScore(Game $game, SaveScoreDTO $payload): Game;
}
