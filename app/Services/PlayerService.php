<?php

namespace App\Services;

use App\Contracts\PlayerRepositoryInterface;
use App\Contracts\PlayerServiceInterface;
use App\DTOs\PlayerFilterDTO;
use App\Enums\CacheKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class PlayerService implements PlayerServiceInterface
{
    public function __construct(
        private readonly PlayerRepositoryInterface $playerRepository
    )
    {
    }

    public function getWithCache(PlayerFilterDTO $filter): Collection
    {
        return Cache::tags(CacheKeys::PLAYER->value)
            ->remember(
                key: CacheKeys::PLAYER->key($filter),
                ttl: CacheKeys::ttl(),
                callback: fn() => $this->playerRepository->get($filter)
            );
    }
}
