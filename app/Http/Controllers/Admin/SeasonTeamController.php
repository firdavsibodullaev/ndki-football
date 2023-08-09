<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SeasonTeam\SeasonTeamServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeasonTeam\StoreRequest;
use App\Models\Season;
use App\Models\SeasonTeam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeasonTeamController extends Controller
{
    public function __construct(
        private readonly SeasonTeamServiceInterface $seasonTeamService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Season $season): RedirectResponse
    {
        abort_if($season->seasonTeams()->count() > 0, 403);

        $this->seasonTeamService->create($season, $request->toDto());

        return to_route('admin.season.show', $season->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(SeasonTeam $seasonTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeasonTeam $seasonTeam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SeasonTeam $seasonTeam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeasonTeam $seasonTeam)
    {
        //
    }
}
