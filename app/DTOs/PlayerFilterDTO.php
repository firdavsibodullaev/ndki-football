<?php

namespace App\DTOs;

class PlayerFilterDTO extends BaseDTO
{
    public function __construct(
        public readonly ?int $team_id = null
    )
    {
    }
}
