<?php

namespace App\Contracts\Game;

interface GameRepositoryInterface
{
    public function insert(array $items): bool;
}
