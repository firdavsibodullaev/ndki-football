<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\TeamServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function __construct(private readonly TeamServiceInterface $teamService)
    {
    }

    public function index(): Response
    {
        return Inertia::render('Team/Index', [
            'teams' => $this->teamService->fetchActive()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Team/Create');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
