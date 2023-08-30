<?php

namespace App\Contracts\Season;

use App\DTOs\Season\SeasonDTO;
use App\DTOs\Season\SeasonParametersDTO;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

interface SeasonRepositoryInterface
{
    public function get(SeasonParametersDTO $parameters = new SeasonParametersDTO()): Collection;

    public function create(SeasonDTO $payload): Season;

    public function update(Season $season, SeasonDTO $payload): Season;

    public function updateDates(Season $season, Carbon $started_at, ?Carbon $finished_at = null);
}
