<?php

namespace App\Repositories;

use App\Contracts\Game\GameRepositoryInterface;
use App\Enums\Game as GameEnum;
use App\Models\Game;
use App\Models\GamePlayer;

class GameRepository implements GameRepositoryInterface
{
    public function insert(array $items): bool
    {
        return Game::query()->insert($items);
    }

    public function start(Game $game): Game
    {
        $game->fill([
            'status' => GameEnum::PLAYING,
            'started_at' => now()
        ]);
        $game->save();

        return $game;
    }
}
