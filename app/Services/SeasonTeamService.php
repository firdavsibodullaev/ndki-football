<?php

namespace App\Services;

use App\Contracts\SeasonTeam\SeasonTeamRepositoryInterface;
use App\Contracts\SeasonTeam\SeasonTeamServiceInterface;
use App\Contracts\Team\TeamRepositoryInterface;
use App\DTOs\SeasonTeam\SeasonTeamDTO;
use App\Models\Season;

readonly class SeasonTeamService implements SeasonTeamServiceInterface
{
    public function __construct(
        private SeasonTeamRepositoryInterface $seasonTeamRepository,
        private TeamRepositoryInterface       $teamRepository
    )
    {
    }

    public function create(Season $season, SeasonTeamDTO $payload): Season
    {
        $payload = $this->preparePayload($payload);

        return $this->seasonTeamRepository->create($season, $payload);
    }

    private function preparePayload(SeasonTeamDTO $payload): SeasonTeamDTO
    {
        return new SeasonTeamDTO(
            team_ids: $this->teamRepository
                ->getById($payload->toArray())
                ->sortBy('name')
                ->pluck('id')
                ->toArray()
        );
    }
}
