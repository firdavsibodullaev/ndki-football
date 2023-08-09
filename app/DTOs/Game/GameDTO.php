<?php

namespace App\DTOs\Game;

use Illuminate\Support\Carbon;

class GameDTO
{
    public function __construct(
        public readonly Carbon $started_at,
        public readonly Carbon $finished_at,
        public readonly array  $days
    )
    {
    }
}
