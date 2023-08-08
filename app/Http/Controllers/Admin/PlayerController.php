<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\PlayerServiceInterface;
use App\Contracts\TeamServiceInterface;
use App\Enums\FromRoute;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\FilterRequest;
use App\Http\Requests\Player\StoreRequest;
use App\Http\Requests\Player\UpdateRequest;
use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PlayerController extends Controller
{
    public function __construct(
        private readonly PlayerServiceInterface $playerService,
        private readonly TeamServiceInterface   $teamService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(FilterRequest $request): View
    {
        $players = $this->playerService->getWithCache($request->toDto());

        return view('admin.player.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.player.create', [
            'teams' => $this->teamService->fetchActive()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->playerService->createAndClearCache($request->toDto());

        return to_rroute('admin.player.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player): View
    {
        return view('admin.player.show', [
            'player' => $player->load(['team', 'avatar'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player): View
    {
        return view('admin.player.edit', [
            'player' => $player,
            'teams' => $this->teamService->fetchActive()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Player $player): RedirectResponse
    {
        $this->playerService->updateAndClearCache($player, $request->toDto());

        $route = FromRoute::tryFrom($request->query('from', FromRoute::PLAYER_LIST->value))->getRouteName();

        $id = $request->query('id');

        return to_rroute($route->name, [$route->variable => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player): RedirectResponse
    {
        $this->playerService->deleteAndClearCache($player);

        return to_rroute('admin.player.index');
    }
}
