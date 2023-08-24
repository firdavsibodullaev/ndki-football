<?php

namespace App\Repositories;

use App\Contracts\Game\GameRepositoryInterface;
use App\Models\Game;
use Illuminate\Support\Collection;

class GameRepository implements GameRepositoryInterface
{
    public function insert(array $items): bool
    {
        return Game::query()->insert($items);
    }
}
