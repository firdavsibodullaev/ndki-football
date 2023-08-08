<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\SeasonTeam;
use Illuminate\Http\Request;

class SeasonTeamController extends Controller
{
    public function __construct()
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
    public function store(Request $request, Season $season)
    {
        abort_if($season->seasonTeams()->count() > 0, 403);

        //
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
