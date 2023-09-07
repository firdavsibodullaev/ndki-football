<?php

namespace App\Contracts\User;

use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UserDTO;
use App\Models\User;

interface UserServiceInterface
{
    public function update(User $user, UserDTO $payload): User;

    public function updatePassword(User $user, PasswordDTO $payload): User;
}
