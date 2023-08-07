<?php

namespace App\Contracts;

use App\DTOs\PlayerFilterDTO;
use Illuminate\Database\Eloquent\Collection;

interface PlayerRepositoryInterface
{
    public function get(PlayerFilterDTO $filter): Collection;
}
