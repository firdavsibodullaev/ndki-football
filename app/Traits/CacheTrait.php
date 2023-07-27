<?php

namespace App\Traits;

trait CacheTrait
{
    public function key(object $parameters): string
    {
        $parameters = array_values(get_object_vars($parameters));

        return '';
    }

    public static function ttl(): int
    {
        return 3600 * 24;
    }
}
