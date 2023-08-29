<?php

namespace App\Services;

use App\Collections\GamesCollection;
use App\Collections\RoundCollection;
use App\Contracts\Game\GameRepositoryInterface;
use App\Contracts\Game\GameServiceInterface;
use App\Contracts\Season\SeasonRepositoryInterface;
use App\DTOs\Game\GameDTO;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

readonly class GameService implements GameServiceInterface
{
    public function __construct(
        private GameRepositoryInterface   $gameRepository,
        private SeasonRepositoryInterface $seasonRepository
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

    private function getDeadlineDates(GamesCollection $payload): array
    {
        return $payload->pluck('*.game_at')->flatten()->sort()->toArray();
    }
}
