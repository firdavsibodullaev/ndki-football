<?php

namespace App\Repositories;

use App\Contracts\SeasonTeam\SeasonTeamRepositoryInterface;
use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Models\Season;
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
}
