<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Game\GameServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\StoreRequest;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    public function __construct(
        private readonly GameServiceInterface $gameService
    )
    {
    }

    public function store(StoreRequest $request, Season $season): RedirectResponse
    {
        $this->gameService->create($season, $request->toDto());

        return to_route('admin.season.show', $season->id);
    }
}
