<?php

use Illuminate\Support\Str;

if (!function_exists('rroute')) {
    function rroute($name, $parameters = [], $absolute = true): string
    {
        $query_parameters = query_from_request();
        return route($name, $parameters, $absolute) . $query_parameters;
    }
}

if (!function_exists('to_rroute')) {
    function to_rroute($route, $parameters = [], $status = 302, $headers = [])
    {
        $parameters = $parameters + request()->query();

        return redirect()->route($route, $parameters, $status, $headers);
    }
}

if (!function_exists('query_from_request')) {
    function query_from_request(): string
    {
        $query_parameters = http_build_query(request()->query());

        return $query_parameters
            ? '?' . $query_parameters
            : '';
    }
}

if (!function_exists('get_initials')) {
    function get_initials(?string $value)
    {
        if (is_null($value)) {
            return null;
        }

        $first_two_letters = Str::of($value)->ucfirst()->substr(0, 2);

        if ($first_two_letters->contains(['Ch', 'Sh', 'O\'', 'G\'', 'Ng'])) {
            return $first_two_letters->toString();
        }

        return ucfirst($value)[0];
    }
}
