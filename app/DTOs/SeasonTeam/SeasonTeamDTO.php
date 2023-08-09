<?php

namespace App\DTOs\SeasonTeam;

class SeasonTeamDTO
{
    public function __construct(
        public readonly array $team_ids
    )
    {
    }
}
