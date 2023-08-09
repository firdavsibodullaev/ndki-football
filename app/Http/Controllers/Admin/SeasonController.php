<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Season\SeasonServiceInterface;
use App\Contracts\Team\TeamServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Season\StoreRequest;
use App\Http\Requests\Season\UpdateRequest;
use App\Models\Season;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as ApplicationAlias;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function __construct(
        private readonly SeasonServiceInterface $seasonService,
        private readonly TeamServiceInterface   $teamService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $seasons = $this->seasonService->getListLastFirstWithCache();

        return view('admin.season.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.season.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $season = $this->seasonService->createAndClearCache($request->toDto());

        return to_route('admin.season.show', $season->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Season $season): View|ApplicationAlias|Factory|Application
    {
        $season = $season->load(['seasonTeams.team', 'games']);

        return view('admin.season.show', compact('season'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Season $season): View|ApplicationAlias|Factory|Application
    {
        return view('admin.season.edit', compact('season'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Season $season): \Illuminate\Http\RedirectResponse
    {
        $this->seasonService->updateAndClearCache($season, $request->toDto());

        return to_route('admin.season.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Season $season)
    {
        //
    }
}
