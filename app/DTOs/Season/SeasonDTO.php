<?php

namespace App\DTOs\Season;

use App\DTOs\BaseDTO;

class SeasonDTO extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public readonly int    $tournament_id
    )
    {
    }
}
