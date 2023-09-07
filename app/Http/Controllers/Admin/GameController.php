<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Game\GameServiceInterface;
use App\Enums\CacheKeys;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\SaveScoreRequest;
use App\Http\Requests\Game\StartGameRequest;
use App\Http\Requests\Game\StoreRequest;
use App\Http\Resources\GameResource;
use App\Http\Resources\SeasonResource;
use App\Models\Game;
use App\Models\Season;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    public function __construct(
        private readonly GameServiceInterface $gameService
    )
    {
    }

    public function show(Season $season, Game $game): View
    {
        abort(404);

        cache()->put(
            key: CacheKeys::GAME_ID->key(['start' => LARAVEL_START, 'user_id' => auth()->id()]),
            value: $game->id,
            ttl: 1
        );

        return view('admin.season.game.show', [
            'season' => $season,
            'game' => $game->load([
                    'away.players.player',
                    'away.team.logo',
                    'home.team.logo',
                    'home.players.player'
                ]
            )
        ]);
    }

    public function showJson(Season $season, Game $game): JsonResponse
    {
        cache()->put(
            key: CacheKeys::GAME_ID->key(['start' => LARAVEL_START, 'user_id' => auth()->id()]),
            value: $game->id,
            ttl: 1
        );

        return response()->json([
            'data' => GameResource::make(
                resource: $game
                    ->setRelation('season', $season)
                    ->load([
                        'away.players.player',
                        'away.team.logo',
                        'home.team.logo',
                        'home.players.player'
                    ])
            )
        ]);
    }

    public function store(StoreRequest $request, Season $season): RedirectResponse
    {
        $this->gameService->create($season, $request->toDto());

        return to_route('admin.season.show', $season->id);
    }

    public function saveScore(SaveScoreRequest $request, Season $season, Game $game): RedirectResponse
    {
        abort_unless(is_null($game->finished_at), 400, __('Игра уже была проведена'));

        $this->gameService->saveScore($season, $game, $request->toDto());

        return to_route('admin.season.show', $season->id);
    }

    public function start(StartGameRequest $request, Season $season, Game $game): RedirectResponse
    {
        abort(404);

        $this->gameService->start($season, $game, $request->toDto());

        return redirect()->back();
    }

    public function finish(Season $season, Game $game): RedirectResponse
    {
        abort(404);

        $this->gameService->finish($game);

        return redirect()->back();
    }
}
