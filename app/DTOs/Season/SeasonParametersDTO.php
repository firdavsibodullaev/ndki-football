<?php

namespace App\DTOs\Season;

class SeasonParametersDTO
{
    public function __construct(
        public readonly ?OrderParameterDTO $order_by = null
    )
    {
    }

    public static function make(
        ?OrderParameterDTO $order_by = null
    ): static
    {
        return new static($order_by);
    }
}
