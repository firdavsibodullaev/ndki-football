<?php

namespace App\Contracts\SeasonTeam;

use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Models\Season;

interface SeasonTeamRepositoryInterface
{
    public function create(Season $season, SeasonTeamDTO $payload): Season;
}
