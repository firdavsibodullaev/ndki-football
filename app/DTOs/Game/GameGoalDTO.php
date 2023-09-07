<?php

namespace App\DTOs\Game;

use App\DTOs\BaseDTO;

class GameGoalDTO extends BaseDTO
{
    public function __construct(
        public readonly int $scored,
        public readonly int $conceded
    )
    {
    }

    public function opponent(): static
    {
        return new static($this->conceded, $this->scored);
    }
}
