<?php

namespace App\Enums;

enum Game: string
{
    case PENDING = 'pending';
    case PLAYING = 'playing';
    case PLAYED = 'played';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function translate(): string
    {
        return match ($this) {
            self::PENDING => __('В ожидании'),
            self:: PLAYING => __('Матч идет'),
            self::PLAYED => __('Сыграно')
        };
    }

    public function isPending(): bool
    {
        return $this->value === self::PENDING->value;
    }

    public function isPlaying(): bool
    {
        return $this->value === self::PLAYING->value;
    }
}
