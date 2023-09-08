<?php

namespace App\DTOs\Season;

use App\DTOs\BaseDTO;

class OrderParameterDTO extends BaseDTO
{
    public function __construct(
        public readonly string $column,
        public readonly string $direction
    )
    {
    }

    public static function make(
        string $column,
        string $direction
    ): static
    {
        return new static($column, $direction);
    }
}
