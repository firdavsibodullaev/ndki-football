<?php

namespace App\Contracts\GamePlayer;

interface GamePlayerRepositoryInterface
{
    public function insert(array $payload): bool;
}
