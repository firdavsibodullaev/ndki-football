<?php

namespace App\Contracts\Game;

use Illuminate\Support\Collection;

interface GameRepositoryInterface
{
    public function create(Collection $games);
}
