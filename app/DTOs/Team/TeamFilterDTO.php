<?php

namespace App\DTOs\Team;

use App\DTOs\BaseDTO;
use App\Enums\Team;

class TeamFilterDTO extends BaseDTO
{

    public function __construct(
        public readonly ?Team $fetch_only = null,
        public readonly ?int  $season_id = null
    )
    {
    }
}
