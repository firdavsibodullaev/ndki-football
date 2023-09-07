<?php

namespace App\DTOs\User;

use App\DTOs\BaseDTO;

class UserDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $username
    )
    {
    }
}
