<?php

namespace App\Contracts\Tournament;

use App\DTOs\Tournament\TournamentDTO;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;

interface TournamentRepositoryInterface
{
    public function get(): Collection;

    public function create(TournamentDTO $payload): Tournament;

    public function update(Tournament $tournament, TournamentDTO $payload): Tournament;

    public function delete(Tournament $tournament): void;
}
