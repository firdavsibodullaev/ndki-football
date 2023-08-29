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
}
