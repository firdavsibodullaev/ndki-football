<?php

namespace App\Enums;

enum Role: int
{
    case ADMIN = 1;

    case MODERATOR = 2;

    public function translate(): string
    {
        return match ($this) {
            self::ADMIN => __('Администратор'),
            self::MODERATOR => __('Модератор'),
        };
    }

    public function isAdmin(): bool
    {
        return $this->value === self::ADMIN->value;
    }
}
