<?php

namespace App\Constants;

use Illuminate\Support\Facades\Route;

class RouteActive
{
    public static function make(): static
    {
        return new static();
    }

    public function current(): ?string
    {
        return Route::currentRouteName();
    }

    public function isMainPage(): bool
    {
        return $this->current() === 'admin.index';
    }

    public function isList(): bool
    {
        return $this->isTeamList();
    }

    public function isTeamList(): bool
    {
        return in_array($this->current(), [
            'admin.team.index',
            'admin.team.create',
            'admin.team.edit',
            'admin.team.show',
        ]);
    }
}