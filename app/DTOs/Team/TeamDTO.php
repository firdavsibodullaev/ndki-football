<?php

namespace App\DTOs\Team;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class TeamDTO extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public bool            $is_active = true,
        public ?UploadedFile   $logo = null
    )
    {
    }
}
