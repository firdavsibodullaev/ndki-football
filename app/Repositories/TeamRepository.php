<?php

namespace App\Repositories;

use App\Contracts\Team\TeamRepositoryInterface;
use App\DTOs\Team\TeamDTO;
use App\DTOs\Team\TeamFilterDTO;
use App\Enums\Team as TeamEnum;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements TeamRepositoryInterface
{
    public function fetch(TeamFilterDTO $dto = new TeamFilterDTO()): Collection
    {
        return Team::query()
            ->with('logo')
            ->when(
                value: $dto->fetch_only,
                callback: fn(Builder $builder) => $builder->when(
                    value: $dto->fetch_only->is(TeamEnum::ONLY_ACTIVE),
                    callback: fn(Builder $builder) => $builder->where('is_active', true),
                    default: fn(Builder $builder) => $builder->where('is_active', false)
                )
            )
            ->when(
                value: $dto->season_id,
                callback: fn(Builder $builder) => $builder->whereHas(
                    relation: 'seasons',
                    callback: fn(Builder $subBuilder) => $subBuilder->whereKey($dto->season_id)
                )
            )
            ->get();
    }

    public function getById(array $ids): Collection
    {
        return Team::query()->find($ids);
    }

    public function create(TeamDTO $payload): Team
    {
        $team = new Team($payload->toArray());
        $team->save();

        return $team;
    }

    public function update(Team $team, TeamDTO $payload): Team
    {
        $team->fill($payload->toArray());
        $team->save();

        return $team;
    }
}
