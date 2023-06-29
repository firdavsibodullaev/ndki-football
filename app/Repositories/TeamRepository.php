<?php

namespace App\Repositories;

use App\Contracts\TeamRepositoryInterface;
use App\DTOs\TeamDTO;
use App\Enums\Team as TeamEnum;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements TeamRepositoryInterface
{
    public function fetch(TeamDTO $dto): Collection
    {
        return Team::query()
            ->when($dto->fetch_only->is(TeamEnum::ONLY_ACTIVE),
                fn(Builder $builder) => $builder->where('is_active', true)
            )
            ->when($dto->fetch_only->is(TeamEnum::ONLY_INACTIVE),
                fn(Builder $builder) => $builder->where('is_active', false)
            )->get();
    }
}
