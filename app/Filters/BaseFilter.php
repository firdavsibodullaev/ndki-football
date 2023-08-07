<?php

namespace App\Filters;

abstract class BaseFilter
{
    public function __construct(
        protected readonly ?string $column = null
    )
    {
    }
}
