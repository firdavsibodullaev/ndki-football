<?php

namespace App\DTOs\Season;

class SeasonParametersDTO
{
    public function __construct(
        public readonly ?OrderParameterDTO $order_by = null,
        public readonly ?array             $relations = null
    )
    {
    }

    public static function make(
        ?OrderParameterDTO $order_by = null,
        ?array             $relations = null
    ): static
    {
        return new static($order_by, $relations);
    }
}
