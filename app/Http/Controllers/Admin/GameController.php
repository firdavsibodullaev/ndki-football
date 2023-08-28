<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Game\GameServiceInterface;
use App\Http\Controllers\Controller;
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
        return view('admin.season.game.show', [
            'season' => $season,
            'game' => $game->load(['away.players', 'away.logo', 'home.logo', 'home.players'])
        ]);
    }

    public function store(StoreRequest $request, Season $season): RedirectResponse
    {
        $this->gameService->create($season, $request->toDto());

        return to_route('admin.season.show', $season->id);
    }
}
