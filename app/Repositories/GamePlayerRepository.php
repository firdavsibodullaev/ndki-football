<?php

namespace App\Repositories;

use App\Contracts\GamePlayer\GamePlayerRepositoryInterface;
use App\Models\GamePlayer;

class GamePlayerRepository implements GamePlayerRepositoryInterface
{
    public function insert(array $payload): bool
    {
        return GamePlayer::query()->insert($payload);
    }
}
