<?php

namespace App\Repositories;

use App\Contracts\User\UserRepositoryInterface;
use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UserDTO;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function update(User $user, UserDTO $payload): User
    {
        $user->fill($payload->toArray());
        $user->save();

        return $user;
    }

    public function updatePassword(User $user, PasswordDTO $payload): User
    {
        $user->fill(['password' => $payload->bcrypt()]);
        $user->save();

        return $user;
    }
}
