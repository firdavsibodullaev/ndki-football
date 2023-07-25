<?php

namespace App\DTOs;

use App\Enums\Team;

class TeamDTO
{
    public function __construct(public readonly Team $fetch_only)
    {
    }
}
