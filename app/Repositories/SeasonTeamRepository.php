<?php

namespace App\Repositories;

use App\Contracts\SeasonTeam\SeasonTeamRepositoryInterface;
use App\DTOs\Game\GameGoalDTO;
use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Enums\GameResult;
use App\Models\Season;
use App\Models\SeasonTeam;
use Illuminate\Database\Eloquent\Collection;

class SeasonTeamRepository implements SeasonTeamRepositoryInterface
{
    public function create(Season $season, SeasonTeamDTO $payload): Season
    {
        $season->seasonTeams()->createMany(
            array_map(fn(string $team_id) => ['team_id' => (int)$team_id], $payload->team_ids)
        );

        return $season;
    }

    public function game(SeasonTeam $seasonTeam, GameGoalDTO $goals, GameResult $result): SeasonTeam
    {
        $seasonTeam->fill([
            'goals_scored' => $seasonTeam->goals_scored + $goals->scored,
            'goals_conceded' => $seasonTeam->goals_conceded + $goals->conceded,
            'points' => $seasonTeam->points + $result->points(),
            'victory' => $seasonTeam->victory + (int)$result->isVictory(),
            'defeat' => $seasonTeam->defeat + (int)$result->isDefeat(),
            'draw' => $seasonTeam->draw + (int)$result->isDraw(),
        ]);
        $seasonTeam->save();

        return $seasonTeam;
    }

}
