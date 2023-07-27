<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\TeamServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TeamController extends Controller
{
    public function __construct(private readonly TeamServiceInterface $teamService)
    {
    }

    public function index(): View
    {
        return view('admin.team.index', [
            'teams' => $this->teamService->fetchAll()
        ]);
    }

    public function show(Team $team): View
    {
        $team = $team->load(['logo', 'players']);
        return view('admin.team.show', compact('team'));
    }

    public function create(): View
    {
        return view('admin.team.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->teamService->createAndClearCache($request->toDto());

        return to_route('admin.team.index');
    }

    public function edit(Team $team): View
    {
        $team = $team->load(['logo', 'players']);
        return view('admin.team.edit', compact('team'));
    }

    public function update(UpdateRequest $request, Team $team): RedirectResponse
    {
        $this->teamService->updateAndClearCache($team, $request->toDto());

        return to_route('admin.team.index');
    }
}
