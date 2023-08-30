<?php

namespace App\DTOs\Game\Start;

use App\DTOs\BaseDTO;

class StartGameDTO extends BaseDTO
{
    public function __construct(
        public ParticipantDTO $home,
        public ParticipantDTO $away
    )
    {
    }
}
