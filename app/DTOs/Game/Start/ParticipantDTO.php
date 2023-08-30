<?php

namespace App\DTOs\Game\Start;

use App\DTOs\BaseDTO;
use Illuminate\Support\Collection;

class ParticipantDTO extends BaseDTO
{
    public function __construct(
        public int        $team_id,
        public Collection $players
    )
    {
    }
}
