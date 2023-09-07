<?php

namespace App\DTOs\Game;

use App\DTOs\BaseDTO;

class SaveScoreDTO extends BaseDTO
{
    public function __construct(
        public readonly int $home_goal,
        public readonly int $away_goal
    )
    {
    }
}
