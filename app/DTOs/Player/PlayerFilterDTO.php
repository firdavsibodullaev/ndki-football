<?php

namespace App\DTOs\Player;

use App\DTOs\BaseDTO;

class PlayerFilterDTO extends BaseDTO
{
    public function __construct(
        public readonly ?int $team_id = null
    )
    {
    }
}
