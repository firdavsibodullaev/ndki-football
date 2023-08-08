<?php

namespace App\Enums;

use App\DTOs\RouteNameDTO;

enum FromRoute: string
{
    case PLAYER_LIST = 'player-list';
    case TEAM_LIST = 'team-list';
    case TEAM_SHOW = 'team-show';


    public function getRouteName(): ?RouteNameDTO
    {
        return match ($this->value) {
            self::PLAYER_LIST->value => new RouteNameDTO('admin.player.index'),
            self::TEAM_LIST->value => new RouteNameDTO('admin.team.index'),
            self::TEAM_SHOW->value => new RouteNameDTO('admin.team.show', 'team'),
            default => null
        };
    }
}
