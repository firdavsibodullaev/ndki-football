<?php

namespace App\Enums;

enum Team: string
{
    case ONLY_ACTIVE = 'only_active';
    case ONLY_INACTIVE = 'only_inactive';

    public function is(Team $element): bool
    {
        return $this->value === $element->value;
    }
}
