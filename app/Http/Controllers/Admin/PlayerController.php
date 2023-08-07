<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\PlayerServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Player\FilterRequest;
use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct(
        private readonly PlayerServiceInterface $playerService
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
