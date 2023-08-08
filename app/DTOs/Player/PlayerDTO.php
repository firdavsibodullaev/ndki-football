<?php

namespace App\DTOs\Player;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class PlayerDTO extends BaseDTO
{
    public function __construct(
        public readonly string        $last_name,
        public readonly string        $first_name,
        public readonly string        $patronymic,
        public readonly int           $team_id,
        public readonly int           $number,
        public readonly ?UploadedFile $avatar = null,
        public readonly bool          $is_active = true
    )
    {
    }
}
