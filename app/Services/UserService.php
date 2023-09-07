<?php

namespace App\Services;

use App\Contracts\User\UserRepositoryInterface;
use App\Contracts\User\UserServiceInterface;
use App\DTOs\User\PasswordDTO;
use App\DTOs\User\UpdateDTO;
use App\DTOs\User\UserDTO;
use App\Enums\CacheKeys;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

readonly class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {
    }

    public function getAndCache(): Collection
    {
        return Cache::tags(CacheKeys::USER->value)
            ->remember(
                key: CacheKeys::USER->value,
                ttl: CacheKeys::ttl(),
                callback: fn() => $this->userRepository->get()
            );
    }

    public function createAndClearCache(UserDTO $payload): User
    {
        $user = $this->userRepository->create($payload);

        Cache::tags(CacheKeys::USER->value)->clear();

        return $user;
    }

    public function updateAndClearCache(User $user, UpdateDTO $payload): User
    {
        Cache::tags(CacheKeys::USER->value)->clear();

        return $this->userRepository->update($user, $payload);
    }

    public function updatePasswordAndClearCache(User $user, PasswordDTO $payload): User
    {
        Cache::tags(CacheKeys::USER->value)->clear();

        return $this->userRepository->updatePassword($user, $payload);
    }

    public function deleteAndClearCache(User $user): bool
    {
        $is_deleted = $this->userRepository->delete($user);

        if ($is_deleted) {
            Cache::tags(CacheKeys::USER->value)->clear();
        }

        return $is_deleted;
    }
}
