<?php

namespace App\Repositories;

use App\Contracts\Tournament\TournamentRepositoryInterface;
use App\DTOs\Tournament\TournamentDTO;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;

class TournamentRepository implements TournamentRepositoryInterface
{

    public function get(): Collection
    {
        return Tournament::query()->get();
    }

    public function create(TournamentDTO $payload): Tournament
    {
        $tournament = new Tournament($payload->toArray());
        $tournament->save();

        return $tournament;
    }

    public function update(Tournament $tournament, TournamentDTO $payload): Tournament
    {
        $tournament->fill($payload->toArray());
        $tournament->save();

        return $tournament;
    }

    public function delete(Tournament $tournament): void
    {
        $tournament->delete();
    }
}
