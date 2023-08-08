<?php

namespace App\Services;

use App\Contracts\MediaLibrary\MediaLibraryServiceInterface;
use App\Contracts\Team\TeamRepositoryInterface;
use App\Contracts\Team\TeamServiceInterface;
use App\DTOs\Team\TeamDTO;
use App\DTOs\Team\TeamFilterDTO;
use App\Enums\CacheKeys;
use App\Enums\MediaCollection;
use App\Enums\Team as TeamEnum;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TeamService implements TeamServiceInterface
{
    public function __construct(
        private readonly MediaLibraryServiceInterface $libraryService,
        private readonly TeamRepositoryInterface      $teamRepository
    )
    {
    }

    public function fetchAll(): Collection
    {
        return Cache::tags(CacheKeys::TEAM->value)
            ->remember(
                key: CacheKeys::TEAM->value,
                ttl: CacheKeys::ttl(),
                callback: fn() => $this->teamRepository->fetch()
            );
    }

    public function fetchActive(): Collection
    {
        $dto = new TeamFilterDTO(fetch_only: TeamEnum::ONLY_ACTIVE);

        return Cache::tags(CacheKeys::TEAM->value)
            ->remember(
                key: CacheKeys::TEAM->key($dto),
                ttl: CacheKeys::ttl(),
                callback: fn() => $this->teamRepository->fetch($dto)
            );
    }

    public function createAndClearCache(TeamDTO $payload): Team
    {
        $team = DB::transaction(function () use ($payload) {
            $team = $this->teamRepository->create($payload);

            $this->libraryService->addOneMedia($team, $payload->logo, MediaCollection::TEAM_LOGO);

            return $team;
        });

        Cache::tags(CacheKeys::TEAM->value)->clear();

        return $team;
    }

    public function updateAndClearCache(Team $team, TeamDTO $payload): Team
    {
        $team = DB::transaction(function () use ($team, $payload) {
            $team = $this->teamRepository->update($team, $payload);

            if ($payload->logo) {
                $this->libraryService->addOneMedia($team, $payload->logo, MediaCollection::TEAM_LOGO);
            }

            return $team;
        });

        Cache::tags(CacheKeys::TEAM->value)->clear();

        return $team;
    }
}
