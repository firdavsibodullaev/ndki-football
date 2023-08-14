<?php

namespace App\Contracts\Team;

use App\DTOs\Team\TeamDTO;
use App\DTOs\Team\TeamFilterDTO;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamServiceInterface
{
    public function fetchAll(TeamFilterDTO $filter = new TeamFilterDTO()): Collection;

    public function fetchActive(): Collection;

    public function createAndClearCache(TeamDTO $payload): Team;

    public function updateAndClearCache(Team $team, TeamDTO $payload): Team;

}
