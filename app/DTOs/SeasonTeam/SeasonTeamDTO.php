<?php

namespace App\DTOs\SeasonTeam;

use App\DTOs\BaseDTO;

class SeasonTeamDTO extends BaseDTO
{
    public function __construct(
        public readonly array $team_ids
    )
    {
    }
}
