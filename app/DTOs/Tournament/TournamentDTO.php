<?php

namespace App\DTOs\Tournament;

use App\DTOs\BaseDTO;
use App\Enums\TournamentType;

class TournamentDTO extends BaseDTO
{
    public function __construct(
        public readonly string         $name,
        public readonly TournamentType $type,
        public readonly bool           $is_home_away
    )
    {
    }
}
