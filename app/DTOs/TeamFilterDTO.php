<?php

namespace App\DTOs;

use App\Enums\Team;

class TeamFilterDTO
{
    public function __construct(public readonly ?Team $fetch_only = null)
    {
    }
}
