<?php

namespace App\Services;

use App\Collections\GamesCollection;
use App\Collections\RoundCollection;
use App\Contracts\Game\GameRepositoryInterface;
use App\Contracts\Game\GameServiceInterface;
use App\Contracts\GamePlayer\GamePlayerServiceInterface;
use App\Contracts\Season\SeasonRepositoryInterface;
use App\DTOs\Game\GameDTO;
use App\DTOs\Game\Start\StartGameDTO;
use App\Models\Game;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

readonly class GameService implements GameServiceInterface
{
    public function __construct(
        private GameRepositoryInterface    $gameRepository,
        private SeasonRepositoryInterface  $seasonRepository,
        private GamePlayerServiceInterface $gamePlayerService
    )
    {
    }

    public function create(Season $season, GamesCollection $payload): bool
    {
        $payload->ensure(RoundCollection::class);

        return DB::transaction(function () use ($season, $payload) {
            $inserted = $this->gameRepository->insert(
                items: $this->preparePayload($payload)
            );

            $this->seasonRepository->updateDates($season, ...$this->getDeadlineDates($payload));

            return $inserted;
        });
    }

    public function start(Season $season, Game $game, StartGameDTO $payload)
    {
        return DB::transaction(function () use ($season, $game, $payload) {
            $game = $this->gameRepository->start($game);
            $this->gamePlayerService->create($game, $payload);

            return $game;
        });
    }

    private function preparePayload(GamesCollection $gamesCollection): array
    {
        return $gamesCollection->map(
            function (RoundCollection $roundCollection) {
                $roundCollection->ensure(GameDTO::class);

                return $roundCollection->map(function (GameDTO $game) {

                    $gameArray = $game->toArray();
                    $gameArray['game_at'] = $gameArray['game_at']->toDateTimeString();

                    return $gameArray + $this->getTimestamps();
                })
                    ->toArray();
            })
            ->flatten(1)
            ->toArray();
    }

    private function getTimestamps(): array
    {
        return [
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ];
    }

    private function getDeadlineDates(GamesCollection $payload): array
    {
        return $payload->pluck('*.game_at')->flatten()->sort()->toArray();
    }
}
