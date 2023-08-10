<?php

namespace App\Services;

use App\Contracts\Season\SeasonRepositoryInterface;
use App\Contracts\Season\SeasonServiceInterface;
use App\DTOs\Season\OrderParameterDTO;
use App\DTOs\Season\SeasonDTO;
use App\DTOs\Season\SeasonParametersDTO;
use App\Enums\CacheKeys;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SeasonService implements SeasonServiceInterface
{
    public function __construct(
        private readonly SeasonRepositoryInterface $seasonRepository
    )
    {
    }

    public function getListLastFirstWithCache(SeasonParametersDTO $filter): Collection
    {
        return Cache::tags(CacheKeys::SEASON->value)
            ->remember(
                key: CacheKeys::SEASON->key($filter),
                ttl: CacheKeys::ttl(),
                callback: fn() => $this->seasonRepository->get(parameters: $filter)
            );
    }

    public function createAndClearCache(SeasonDTO $payload): Season
    {
        $season = $this->seasonRepository->create($payload);

        Cache::tags(CacheKeys::SEASON->value)->clear();

        return $season;
    }

    public function updateAndClearCache(Season $season, SeasonDTO $payload): Season
    {
        $season = $this->seasonRepository->update($season, $payload);

        Cache::tags(CacheKeys::SEASON->value)->clear();

        return $season;
    }
}
