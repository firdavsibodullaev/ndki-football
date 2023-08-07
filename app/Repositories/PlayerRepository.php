<?php

namespace App\Repositories;

use App\Contracts\PlayerRepositoryInterface;
use App\DTOs\PlayerFilterDTO;
use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function get(PlayerFilterDTO $filter): Collection
    {
        return Player::query()
            ->with('team')
            ->filter($filter->toArray())
            ->get();
    }
}
