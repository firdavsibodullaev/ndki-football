<?php

namespace App\Contracts;

use App\DTOs\PlayerFilterDTO;
use Illuminate\Database\Eloquent\Collection;

interface PlayerServiceInterface
{
    public function getWithCache(PlayerFilterDTO $filter): Collection;
}
