<?php

namespace App\Contracts\Team;

use App\DTOs\TeamDTO;
use App\DTOs\TeamFilterDTO;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamRepositoryInterface
{
    public function fetch(TeamFilterDTO $dto = new TeamFilterDTO()): Collection;

    public function create(TeamDTO $payload): Team;

    public function update(Team $team, TeamDTO $payload): Team;
}
