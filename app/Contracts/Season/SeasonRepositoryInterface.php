<?php

namespace App\Contracts\Season;

use App\DTOs\Season\SeasonDTO;
use App\DTOs\Season\SeasonParametersDTO;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

interface SeasonRepositoryInterface
{
    public function get(SeasonParametersDTO $parameters = new SeasonParametersDTO()): Collection;

    public function create(SeasonDTO $payload): Season;

    public function update(Season $season, SeasonDTO $payload): Season;
}
