<?php

namespace App\Services;

use App\Contracts\Game\GameRepositoryInterface;
use App\Contracts\Game\GameServiceInterface;
use App\DTOs\Game\GameDTO;
use App\Models\Season;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;

class GameService implements GameServiceInterface
{
    public function __construct(
        private readonly GameRepositoryInterface $gameRepository
    )
    {
    }

    public function create(Season $season, GameDTO $payload): bool
    {
        $period = CarbonPeriod::create($payload->started_at, '1 day', $payload->finished_at);
        $season = $season->loadMissing('seasonTeams');

        $dates = [];
        /** @var Carbon $day */
        foreach ($period as $day) {
            if (in_array($day->dayOfWeek, $payload->days)) {
                $dates[] = $day;
            }
        }

        $games = $this->prepareGames($season, $season->seasonTeams, $dates);

        return $this->gameRepository->create($games->sortBy(fn(array $game) => $game['game_at'])->values());
    }

    private function prepareGames(Season $season, Collection $seasonTeams, array $dates): SupportCollection
    {
        $teams = $seasonTeams->pluck('id')->shuffle();
        $teamsNumber = $seasonTeams->count();

        $first_day = $dates[0];
        $last_day = last($dates);
        unset($dates[0], $dates[count($dates) - 1]);
        shuffle($dates);

        if ($teamsNumber % 2 !== 0) {
            $teams->push(0);
        }
        $games = collect();
        for ($round = 1; $round < $teamsNumber; $round++) {
            for ($i = 0; $i < $teamsNumber / 2; $i++) {
                $dates = array_values($dates);

                $date = $round === 1 && $i === 0
                    ? $first_day
                    : ($round === $teamsNumber - 1 && $i === $teamsNumber / 2 - 1
                        ? $last_day
                        : $dates[0]);

                unset($dates[0]);

                $team_1 = $teams[$i];
                $team_2 = $teams[$teamsNumber - 1 - $i];

                if ($team_2 !== 0) {
                    $games->push([
                        'team_1' => $team_1,
                        'team_2' => $team_2,
                        'season_id' => $season->id,
                        'game_at' => $date
                    ]);
                }

                $teams->splice(1, 0, $teams->pop());
            }
        }

        return $games;
    }
}
