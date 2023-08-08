<?php

namespace App\Contracts\Player;

use App\DTOs\Player\PlayerDTO;
use App\DTOs\Player\PlayerFilterDTO;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

interface PlayerServiceInterface
{
    public function getWithCache(PlayerFilterDTO $filter): Collection;

    public function createAndClearCache(PlayerDTO $payload): Player;

    public function updateAndClearCache(Player $player, PlayerDTO $payload): Player;

    public function deleteAndClearCache(Player $player): ?bool;
}
