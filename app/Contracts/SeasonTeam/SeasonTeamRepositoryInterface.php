<?php

namespace App\Contracts\SeasonTeam;

use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

interface SeasonTeamRepositoryInterface
{
    public function create(Season $season, SeasonTeamDTO $payload): Season;
}
