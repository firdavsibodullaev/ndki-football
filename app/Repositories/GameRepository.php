<?php

namespace App\Repositories;

use App\Contracts\Game\GameRepositoryInterface;
use App\DTOs\Game\SaveScoreDTO;
use App\Enums\Game as GameEnum;
use App\Models\Game;

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

    public function finish(Game $game): Game
    {
        $game->fill([
            'status' => GameEnum::PLAYED,
            'finished_at' => now()
        ]);
        $game->save();

        return $game;
    }

    public function saveScore(Game $game, SaveScoreDTO $payload): Game
    {
        $game->fill([
            'home_goals' => $payload->home_goal,
            'away_goals' => $payload->away_goal,
            'started_at' => now(),
            'finished_at' => now()
        ]);
        $game->save();

        return $game;
    }
}
