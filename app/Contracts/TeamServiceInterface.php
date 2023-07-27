<?php

namespace App\Contracts;

use App\DTOs\TeamDTO;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamServiceInterface
{
    public function fetchAll(): Collection;

    public function fetchActive(): Collection;

    public function createAndClearCache(TeamDTO $payload): Team;

    public function updateAndClearCache(Team $team, TeamDTO $payload): Team;

}
