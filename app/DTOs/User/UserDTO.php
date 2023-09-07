<?php

namespace App\DTOs\User;

use App\DTOs\BaseDTO;
use App\Enums\Role;

class UserDTO extends BaseDTO
{
    public function __construct(
        public string      $name,
        public string      $username,
        public PasswordDTO $password,
        public Role        $role
    )
    {
    }
}
