<?php

namespace App\DTOs;

readonly class RouteNameDTO
{
    public function __construct(
        public string  $name,
        public ?string $variable = null
    )
    {
    }
}
