<?php

namespace App\Services;

use App\Contracts\SeasonTeam\SeasonTeamRepositoryInterface;
use App\Contracts\SeasonTeam\SeasonTeamServiceInterface;
use App\Contracts\Team\TeamRepositoryInterface;
use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Enums\CacheKeys;
use App\Models\Season;
use App\Repositories\TeamRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

readonly class SeasonTeamService implements SeasonTeamServiceInterface
{
    public function __construct(
        private SeasonTeamRepositoryInterface $seasonTeamRepository,
    )
    {
    }

    public function create(Season $season, SeasonTeamDTO $payload): Season
    {
        return $this->seasonTeamRepository->create($season, $payload);
    }
}
