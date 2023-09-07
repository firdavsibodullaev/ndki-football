<?php

namespace App\Repositories;

use App\Contracts\User\UserRepositoryInterface;
use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UpdateDTO;
use App\DTOs\User\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function get(): Collection
    {
        return User::query()->with('avatar')->get();
    }

    public function create(UserDTO $payload): User
    {
        $user = new User([
            'name' => $payload->name,
            'username' => $payload->username,
            'password' => $payload->password->bcrypt(),
            'role' => $payload->role
        ]);
        $user->save();

        return $user;
    }

    public function update(User $user, UpdateDTO $payload): User
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

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
