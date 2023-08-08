<?php

namespace App\Repositories;

use App\Contracts\Player\PlayerRepositoryInterface;
use App\DTOs\PlayerDTO;
use App\DTOs\PlayerFilterDTO;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function get(PlayerFilterDTO $filter): Collection
    {
        return Player::query()
            ->with(['team', 'avatar'])
            ->filter($filter->toArray())
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
