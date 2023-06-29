<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\TeamServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function __construct(private readonly TeamServiceInterface $teamService)
    {
    }

    public function index()
    {
        return Inertia::render('Team/Index', [
            'teams' => $this->teamService->fetchActive()
        ]);
    }
}
