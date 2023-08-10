<?php

namespace App\Services;

use App\Contracts\Tournament\TournamentRepositoryInterface;
use App\Contracts\Tournament\TournamentServiceInterface;
use App\DTOs\Tournament\TournamentDTO;
use App\Enums\CacheKeys;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class TournamentService implements TournamentServiceInterface
{
    public function __construct(
        private readonly TournamentRepositoryInterface $tournamentRepository
    )
    {
    }

    public function getWithCache(): Collection
    {
        return Cache::tags(CacheKeys::TOURNAMENT->value)
            ->remember(
                key: CacheKeys::TOURNAMENT->value,
                ttl: CacheKeys::ttl(),
                callback: fn() => $this->tournamentRepository->get()
            );
    }

    public function createAndClearCache(TournamentDTO $payload): Tournament
    {
        $tournament = $this->tournamentRepository->create($payload);

        Cache::tags(CacheKeys::TOURNAMENT->value)->clear();

        return $tournament;
    }

    public function updateAndClearCache(Tournament $tournament, TournamentDTO $payload): Tournament
    {
        $tournament = $this->tournamentRepository->update($tournament, $payload);

        Cache::tags(CacheKeys::TOURNAMENT->value)->clear();

        return $tournament;
    }

    public function deleteAndClearCache(Tournament $tournament): void
    {

        $this->tournamentRepository->delete($tournament);

        Cache::tags(CacheKeys::TOURNAMENT->value)->clear();
    }
}
