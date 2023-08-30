<?php

namespace App\DTOs\Game\Start;

use App\DTOs\BaseDTO;

class PlayerDTO extends BaseDTO
{
    public function __construct(
        public int  $player_id,
        public bool $on_start
    )
    {
    }
}
