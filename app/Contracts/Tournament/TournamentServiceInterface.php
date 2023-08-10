<?php

namespace App\Contracts\Tournament;

use App\DTOs\Tournament\TournamentDTO;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;

interface TournamentServiceInterface
{
    public function getWithCache(): Collection;

    public function createAndClearCache(TournamentDTO $payload): Tournament;

    public function updateAndClearCache(Tournament $tournament, TournamentDTO $payload): Tournament;

    public function deleteAndClearCache(Tournament $tournament): void;
}
