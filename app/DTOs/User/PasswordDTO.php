<?php

namespace App\DTOs\User;

use App\DTOs\BaseDTO;
use SensitiveParameter;

class PasswordDTO extends BaseDTO
{
    public function __construct(
        #[SensitiveParameter] public string $password
    )
    {
    }

    public function bcrypt(): string
    {
        return bcrypt($this->password);
    }
}
