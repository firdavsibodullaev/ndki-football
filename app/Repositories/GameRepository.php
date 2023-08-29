<?php

namespace App\Repositories;

use App\Contracts\Game\GameRepositoryInterface;
use App\Models\Game;

class GameRepository implements GameRepositoryInterface
{
    public function insert(array $items): bool
    {
        return Game::query()->insert($items);
    }
}
