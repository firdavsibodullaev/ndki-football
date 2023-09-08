<?php

namespace App\Repositories;

use App\Contracts\Player\PlayerRepositoryInterface;
use App\DTOs\Player\PlayerDTO;
use App\DTOs\Player\PlayerFilterDTO;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function get(PlayerFilterDTO $filter): Collection
    {
        return Player::filter($filter->toArray())
            ->with(['team', 'avatar'])
            ->get();
    }

    public function create(PlayerDTO $payload): Player
    {
        $player = new Player($payload->toArray());
        $player->save();

        return $player;
    }

    public function update(Player $player, PlayerDTO $payload): Player
    {
        $player->fill($payload->toArray());
        $player->save();

        return $player;
    }

    public function delete(Player $player): ?bool
    {
        return $player->delete();
    }
}
