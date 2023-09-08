<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SeasonTeam\SeasonTeamServiceInterface;
use App\Contracts\Team\TeamServiceInterface;
use App\DTOs\Team\TeamFilterDTO;
use App\Enums\Team;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeasonTeam\StoreRequest;
use App\Http\Resources\TeamResource;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SeasonTeamController extends Controller
{
    public function __construct(
        private readonly SeasonTeamServiceInterface $seasonTeamService,
        private readonly TeamServiceInterface       $teamService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Season $season): AnonymousResourceCollection
    {
        $teams = $this->teamService->fetchAll(
            new TeamFilterDTO(fetch_only: Team::ONLY_ACTIVE, season_id: $season->id)
        );

        return TeamResource::collection($teams);
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
}
