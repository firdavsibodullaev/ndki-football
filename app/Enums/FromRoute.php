<?php

namespace App\Enums;

use App\DTOs\RouteNameDTO;

enum FromRoute: string
{
    case PLAYER_LIST = 'player-list';
    case SEASON_LIST = 'season-list';
    case TEAM_LIST = 'team-list';
    case TEAM_SHOW = 'team-show';
    case TOURNAMENT_SHOW = 'tournament-show';


    public function getRouteName(): ?RouteNameDTO
    {
        return match ($this->value) {
            self::PLAYER_LIST->value => new RouteNameDTO('admin.player.index'),
            self::SEASON_LIST->value => new RouteNameDTO('admin.season.index'),
            self::TEAM_LIST->value => new RouteNameDTO('admin.team.index'),
            self::TEAM_SHOW->value => new RouteNameDTO('admin.team.show', 'team'),
            self::TOURNAMENT_SHOW->value => new RouteNameDTO('admin.tournament.show', 'tournament'),
            default => null
        };
    }
}
