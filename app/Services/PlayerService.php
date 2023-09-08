<?php

namespace App\Services;

use App\Contracts\MediaLibrary\MediaLibraryServiceInterface;
use App\Contracts\Player\PlayerRepositoryInterface;
use App\Contracts\Player\PlayerServiceInterface;
use App\DTOs\Player\PlayerDTO;
use App\DTOs\Player\PlayerFilterDTO;
use App\Enums\CacheKeys;
use App\Enums\MediaCollection;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

readonly class PlayerService implements PlayerServiceInterface
{
    public function __construct(
        private MediaLibraryServiceInterface $libraryService,
        private PlayerRepositoryInterface    $playerRepository
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

    public function createAndClearCache(PlayerDTO $payload): Player
    {
        $player = DB::transaction(function () use ($payload) {
            $player = $this->playerRepository->create($payload);

            if ($payload->avatar) {
                $this->libraryService->addOneMedia($player, $payload->avatar, MediaCollection::PLAYER_AVATAR);
            }

            return $player;
        });

        Cache::tags(CacheKeys::PLAYER->value)->clear();

        return $player;
    }

    public function updateAndClearCache(Player $player, PlayerDTO $payload): Player
    {
        $player = DB::transaction(function () use ($player, $payload) {
            $player = $this->playerRepository->update($player, $payload);

            if ($payload->avatar) {
                $this->libraryService->addOneMedia($player, $payload->avatar, MediaCollection::PLAYER_AVATAR);
            }

            return $player;
        });

        Cache::tags(CacheKeys::PLAYER->value)->clear();

        return $player;
    }

    public function deleteAndClearCache(Player $player): ?bool
    {
        $is_deleted = $player->delete();

        if ($is_deleted) {
            Cache::tags(CacheKeys::PLAYER->value)->clear();
        }

        return $is_deleted;
    }
}
