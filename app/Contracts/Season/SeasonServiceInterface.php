<?php

namespace App\Contracts\Season;

use App\DTOs\Season\SeasonDTO;
use App\DTOs\Season\SeasonParametersDTO;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

interface SeasonServiceInterface
{
    public function getListLastFirstWithCache(SeasonParametersDTO $filter): Collection;

    public function createAndClearCache(SeasonDTO $payload): Season;

    public function updateAndClearCache(Season $season, SeasonDTO $payload): Season;
}
