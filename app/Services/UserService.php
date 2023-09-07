<?php

namespace App\Services;

use App\Contracts\User\UserRepositoryInterface;
use App\Contracts\User\UserServiceInterface;
use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UserDTO;
use App\Models\User;

readonly class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {
    }

    public function update(User $user, UserDTO $payload): User
    {
        return $this->userRepository->update($user, $payload);
    }

    public function updatePassword(User$user, PasswordDTO $payload): User
    {
        return $this->userRepository->updatePassword($user, $payload);
    }
}
