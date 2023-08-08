<?php

namespace App\DTOs\Season;

use App\DTOs\BaseDTO;
use Illuminate\Support\Carbon;

class SeasonDTO extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public readonly Carbon $started_at,
        public readonly Carbon $finished_at
    )
    {
    }
}