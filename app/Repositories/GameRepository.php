<?php

namespace App\Repositories;

use App\Contracts\Game\GameRepositoryInterface;
use App\Models\Game;
use Illuminate\Support\Collection;

class GameRepository implements GameRepositoryInterface
{
    public function create(Collection $games): bool
    {
        return Game::query()->insert($games->toArray());
    }
}
