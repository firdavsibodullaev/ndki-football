<?php

namespace App\DTOs\Game;

use App\DTOs\BaseDTO;
use Illuminate\Support\Carbon;

readonly class GameDTO extends BaseDTO
{
    public function __construct(
        public int     $season_id,
        public int    $away_id,
        public int    $home_id,
        public Carbon $game_at,
        public int    $round,
    )
    {
    }
}
