<?php

namespace App\Services;

use App\Contracts\TeamRepositoryInterface;
use App\Contracts\TeamServiceInterface;
use App\DTOs\TeamDTO;
use App\Enums\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamService implements TeamServiceInterface
{
    public function __construct(private readonly TeamRepositoryInterface $teamRepository)
    {
    }

    public function fetchActive(): Collection
    {
        $dto = new TeamDTO(fetch_only: Team::ONLY_ACTIVE);

        return $this->teamRepository->fetch($dto);
    }
}
