<?php

namespace App\Traits;

trait CacheTrait
{
    public function key(object|array $parameters): string
    {
        return $this->value . $this->prepareKeyWithParameters($parameters);
    }

    public static function ttl(): int
    {
        return 3600 * 24;
    }

    private function prepareKeyWithParameters(object|array $parameters): string
    {
        $parameters = is_array($parameters) ? $parameters : get_object_vars($parameters);

        $parameters = array_filter($parameters);

        if (empty($parameters)) {
            return '';
        }

        $key_value = '';

        foreach ($parameters as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $value = $this->key($value);
            }
            $key_value .= "|$key=$value";
        }

        return $key_value;
    }
}
