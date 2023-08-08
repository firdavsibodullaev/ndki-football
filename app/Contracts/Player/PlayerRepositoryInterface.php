<?php

namespace App\Contracts\Player;

use App\DTOs\PlayerDTO;
use App\DTOs\PlayerFilterDTO;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

interface PlayerRepositoryInterface
{
    public function get(PlayerFilterDTO $filter): Collection;

    public function create(PlayerDTO $payload): Player;

    public function update(Player $player, PlayerDTO $payload): Player;

    public function delete(Player $player): ?bool;
}
