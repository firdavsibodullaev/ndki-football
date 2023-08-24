<?php

namespace App\Enums;

enum TournamentType: string
{
    case ELIMINATION = 'elimination';

    case POINTS = 'points';

    public function translate(): string
    {
        return match ($this->value) {
            self::ELIMINATION->value => __('На выбывание'),
            self::POINTS->value => __('Очки'),
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function isPoints(): bool
    {
        return $this === self::POINTS;
    }
}
