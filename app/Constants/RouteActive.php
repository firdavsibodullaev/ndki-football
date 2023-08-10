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
        return $this->isTeamList()
            || $this->isPlayerList()
            || $this->isTournamentList();
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

    public function isPlayerList(): bool
    {
        return in_array($this->current(), [
            'admin.player.index',
            'admin.player.create',
            'admin.player.edit',
            'admin.player.show',
        ]);
    }

    public function isTournamentList(): bool
    {
        return in_array($this->current(), [
            'admin.tournament.index',
            'admin.tournament.create',
            'admin.tournament.edit',
            'admin.tournament.show',
        ]);
    }

    public function isMatchesList(): bool
    {
        return $this->isSeasonList();
    }

    public function isSeasonList(): bool
    {
        return in_array($this->current(), [
            'admin.season.index',
            'admin.season.create',
            'admin.season.edit',
            'admin.season.show',
        ]);
    }
}
