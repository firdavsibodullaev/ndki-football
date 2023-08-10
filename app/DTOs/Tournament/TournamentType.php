<?php

namespace App\DTOs\Tournament;

enum TournamentType: string
{
    case POINTS = 'points';

    case ELIMINATION = 'elimination';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
