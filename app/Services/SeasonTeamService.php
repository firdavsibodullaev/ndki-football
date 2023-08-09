<?php

namespace App\Services;

use App\Contracts\SeasonTeam\SeasonTeamRepositoryInterface;
use App\Contracts\SeasonTeam\SeasonTeamServiceInterface;
use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Models\Season;

class SeasonTeamService implements SeasonTeamServiceInterface
{
    public function __construct(
        private readonly SeasonTeamRepositoryInterface $seasonTeamRepository
    )
    {
    }

    public function create(Season $season, SeasonTeamDTO $payload): Season
    {
        return $this->seasonTeamRepository->create($season, $payload);
    }
}
