<?php

namespace App\DTOs;

class RouteNameDTO
{
    public function __construct(
        public readonly string  $name,
        public readonly ?string $variable = null
    )
    {
    }
}
