<?php

namespace App\Contracts\SeasonTeam;

use App\DTOs\Game\GameGoalDTO;
use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Enums\GameResult;
use App\Models\Season;
use App\Models\SeasonTeam;

interface SeasonTeamRepositoryInterface
{
    public function create(Season $season, SeasonTeamDTO $payload): Season;

    public function game(SeasonTeam $seasonTeam, GameGoalDTO $goals, GameResult $result): SeasonTeam;
}
