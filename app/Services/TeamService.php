<?php

namespace App\Services;

use App\Contracts\MediaLibraryRepositoryInterface;
use App\Contracts\TeamRepositoryInterface;
use App\Contracts\TeamServiceInterface;
use App\DTOs\TeamDTO;
use App\DTOs\TeamFilterDTO;
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
        private readonly MediaLibraryRepositoryInterface $libraryRepository,
        private readonly TeamRepositoryInterface         $teamRepository
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

            $this->libraryRepository->addMedia(
                model: $team,
                file: $payload->logo,
                collection: MediaCollection::TEAM_LOGO
            );

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
                $this->libraryRepository->delete($team, MediaCollection::TEAM_LOGO);
                $this->libraryRepository->addMedia(
                    model: $team,
                    file: $payload->logo,
                    collection: MediaCollection::TEAM_LOGO
                );
            }

            return $team;
        });

        Cache::tags(CacheKeys::TEAM->value)->clear();

        return $team;
    }
}
