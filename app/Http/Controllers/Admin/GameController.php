<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Game\GameServiceInterface;
use App\Enums\CacheKeys;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\StartGameRequest;
use App\Http\Requests\Game\StoreRequest;
use App\Models\Game;
use App\Models\Season;
use Illuminate\Contracts\View\View;
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
        cache()->put(
            key: CacheKeys::GAME_ID->key(['user_id' => auth()->id()]),
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

    public function store(StoreRequest $request, Season $season): RedirectResponse
    {
        $this->gameService->create($season, $request->toDto());

        return to_route('admin.season.show', $season->id);
    }

    public function start(StartGameRequest $request, Season $season, Game $game): RedirectResponse
    {
        $this->gameService->start($season, $game, $request->toDto());

        return redirect()->back();
    }

    public function finish(Season $season, Game $game)
    {
        $this->gameService->finish($game);

        return redirect()->back();
    }
}
