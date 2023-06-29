<?php

namespace App\Contracts;

use App\DTOs\TeamDTO;
use Illuminate\Database\Eloquent\Collection;

interface TeamRepositoryInterface
{
    public function fetch(TeamDTO $dto): Collection;
}
