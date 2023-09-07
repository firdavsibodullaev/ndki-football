<?php

namespace App\Enums;

enum GameResult: string
{
    case WIN = 'win';
    case DRAW = 'draw';
    case LOSE = 'lose';

    public function opponent(): GameResult
    {
        return match ($this) {
            self::WIN => self::LOSE,
            self::LOSE => self::WIN,
            self::DRAW => self::DRAW
        };
    }

    public function points(): int
    {
        return match ($this) {
            self::WIN => 3,
            self::DRAW => 1,
            self::LOSE => 0
        };
    }

    public function isVictory(): bool
    {
        return $this->value === self::WIN->value;
    }

    public function isDefeat(): bool
    {
        return $this->value === self::LOSE->value;
    }

    public function isDraw(): bool
    {
        return $this->value === self::DRAW->value;
    }

    public static function getResult(int $home_goal, int $away_goal): GameResult
    {
        $subtraction = $home_goal - $away_goal;

        return match (true) {
            $subtraction > 0 => self::WIN,
            $subtraction === 0 => self::DRAW,
            $subtraction < 0 => self::LOSE
        };
    }
}
