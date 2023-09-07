<?php

namespace App\Contracts\User;

use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UpdateDTO;
use App\DTOs\User\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function get(): Collection;

    public function create(UserDTO $payload): User;

    public function update(User $user, UpdateDTO $payload): User;

    public function updatePassword(User $user, PasswordDTO $payload): User;

    public function delete(User $user): bool;
}
