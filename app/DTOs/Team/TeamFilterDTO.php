<?php

namespace App\DTOs\Team;

use App\Enums\Team;

readonly class TeamFilterDTO
{

    public function __construct(
        public ?Team $fetch_only = null,
        public ?int  $season_id = null
    )
    {
    }
}
