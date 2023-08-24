<?php

namespace App\Services;

use App\Collections\GamesCollection;
use App\Collections\RoundCollection;
use App\Contracts\Game\GameRepositoryInterface;
use App\Contracts\Game\GameServiceInterface;
use App\DTOs\Game\GameDTO;
use App\Models\Season;

readonly class GameService implements GameServiceInterface
{
    public function __construct(
        private GameRepositoryInterface $gameRepository
    )
    {
    }

    public function create(Season $season, GamesCollection $payload): bool
    {
        $payload->ensure(RoundCollection::class);

        return $this->gameRepository->insert(
            items: $this->preparePayload($payload)
        );
    }

    private function preparePayload(GamesCollection $gamesCollection): array
    {
        return $gamesCollection->map(function (RoundCollection $roundCollection) {
            $roundCollection->ensure(GameDTO::class);

            return $roundCollection->map(function (GameDTO $game) {

                $gameArray = $game->toArray();
                $gameArray['game_at'] = $gameArray['game_at']->toDateTimeString();

                return $gameArray + $this->getTimestamps();
            })
                ->toArray();
        })->flatten(1)->toArray();
    }

    private function getTimestamps(): array
    {
        return [
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ];
    }
}
