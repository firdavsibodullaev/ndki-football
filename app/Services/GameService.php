<?php

namespace App\Services;

use App\Collections\GamesCollection;
use App\Collections\RoundCollection;
use App\Contracts\Game\GameRepositoryInterface;
use App\Contracts\Game\GameServiceInterface;
use App\Contracts\GamePlayer\GamePlayerServiceInterface;
use App\Contracts\Season\SeasonRepositoryInterface;
use App\Contracts\SeasonTeam\SeasonTeamRepositoryInterface;
use App\Contracts\SeasonTeam\SeasonTeamServiceInterface;
use App\DTOs\Game\GameDTO;
use App\DTOs\Game\GameGoalDTO;
use App\DTOs\Game\SaveScoreDTO;
use App\DTOs\Game\Start\StartGameDTO;
use App\Enums\CacheKeys;
use App\Enums\GameResult;
use App\Models\Game;
use App\Models\Season;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

readonly class GameService implements GameServiceInterface
{
    public function __construct(
        private GamePlayerServiceInterface $gamePlayerService,
        private GameRepositoryInterface    $gameRepository,
        private SeasonRepositoryInterface  $seasonRepository,
        private SeasonTeamRepositoryInterface $seasonTeamRepository
    )
    {
    }

    public function create(Season $season, GamesCollection $payload): bool
    {
        $payload->ensure(RoundCollection::class);

        $inserted = DB::transaction(function () use ($season, $payload) {
            $inserted = $this->gameRepository->insert(
                items: $this->preparePayload($payload)
            );

            $this->seasonRepository->updateDates($season, ...$this->getDeadlineDates($payload));

            return $inserted;
        });

        Cache::tags(CacheKeys::SEASON->value)->clear();

        return $inserted;
    }

    public function start(Season $season, Game $game, StartGameDTO $payload)
    {
        return DB::transaction(function () use ($season, $game, $payload) {
            $game = $this->gameRepository->start($game);
            $this->gamePlayerService->create($game, $payload);

            return $game;
        });
    }

    public function finish(Game $game): Game
    {
        return $this->gameRepository->finish($game);
    }

    public function saveScore(Season $season, Game $game, SaveScoreDTO $payload): Game
    {
        $game->loadMissing('home', 'away');

        return DB::transaction(function () use ($game, $payload) {
            $game = $this->gameRepository->saveScore($game, $payload);

            $game_result = $this->getResult($payload);
            $game_goal = $this->setGameGoals($payload);

            $this->seasonTeamRepository->game($game->home, $game_goal, $game_result);
            $this->seasonTeamRepository->game($game->away, $game_goal->opponent(), $game_result->opponent());

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

    private function getResult(SaveScoreDTO $payload): GameResult
    {
        return GameResult::getResult($payload->home_goal, $payload->away_goal);
    }

    private function setGameGoals(SaveScoreDTO $payload): GameGoalDTO
    {
        return new GameGoalDTO($payload->home_goal, $payload->away_goal);
    }
}
