<?php

namespace App\Contracts\User;

use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UpdateDTO;
use App\DTOs\User\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getAndCache(): Collection;

    public function createAndClearCache(UserDTO $payload): User;

    public function updateAndClearCache(User $user, UpdateDTO $payload): User;

    public function updatePasswordAndClearCache(User $user, PasswordDTO $payload): User;

    public function deleteAndClearCache(User $user): bool;
}
