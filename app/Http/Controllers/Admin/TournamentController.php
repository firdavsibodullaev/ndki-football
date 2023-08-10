<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Tournament\TournamentServiceInterface;
use App\Enums\TournamentType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tournament\StoreRequest;
use App\Http\Requests\Tournament\UpdateRequest;
use App\Models\Tournament;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TournamentController extends Controller
{
    public function __construct(
        private readonly TournamentServiceInterface $tournamentService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tournaments = $this->tournamentService->getWithCache();

        return view('admin.tournament.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.tournament.create', [
            'types' => TournamentType::cases()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->tournamentService->createAndClearCache($request->toDto());

        return to_route('admin.tournament.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament): View
    {
        return view('admin.tournament.show', [
            'tournament' => $tournament->load('seasons')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournament $tournament): View
    {
        return view('admin.tournament.edit', [
            'tournament' => $tournament,
            'types' => TournamentType::cases()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Tournament $tournament): RedirectResponse
    {
        $this->tournamentService->updateAndClearCache($tournament, $request->toDto());

        return to_route('admin.tournament.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tournament $tournament): RedirectResponse
    {
        $this->tournamentService->deleteAndClearCache($tournament);

        return to_route('admin.tournament.index');
    }
}
