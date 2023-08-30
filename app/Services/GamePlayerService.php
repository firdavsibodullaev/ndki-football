<?php

namespace App\Services;

use App\Contracts\GamePlayer\GamePlayerRepositoryInterface;
use App\Contracts\GamePlayer\GamePlayerServiceInterface;
use App\DTOs\Game\Start\ParticipantDTO;
use App\DTOs\Game\Start\PlayerDTO;
use App\DTOs\Game\Start\StartGameDTO;
use App\Enums\GamePlayerStatus;
use App\Models\Game;

readonly class GamePlayerService implements GamePlayerServiceInterface
{
    public function __construct(
        private GamePlayerRepositoryInterface $gamePlayerRepository
    )
    {
    }

    public function create(Game $game, StartGameDTO $payload): bool
    {
        $home = $this->toArray($game, $payload->home);
        $away = $this->toArray($game, $payload->away);

        return $this->gamePlayerRepository->insert([...$home, ...$away]);
    }

    private function toArray(Game $game, ParticipantDTO $participant)
    {
        return $participant->players->map(
            fn(PlayerDTO $player) => [
                'player_id' => $player->player_id,
                'team_id' => $participant->team_id,
                'game_id' => $game->id,
                'status' => $player->on_start
                    ? GamePlayerStatus::ON_PITCH->value
                    : GamePlayerStatus::SUBSTITUTE->value,
                'played_from' => $player->on_start ? "00:00" : null,
            ]
        )->toArray();
    }
}
