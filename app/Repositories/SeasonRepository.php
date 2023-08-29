<?php

namespace App\Repositories;

use App\Contracts\Season\SeasonRepositoryInterface;
use App\DTOs\Season\OrderParameterDTO;
use App\DTOs\Season\SeasonDTO;
use App\DTOs\Season\SeasonParametersDTO;
use App\Models\Season;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class SeasonRepository implements SeasonRepositoryInterface
{
    public function get(SeasonParametersDTO $parameters = new SeasonParametersDTO()): Collection
    {
        return Season::query()
            ->when(
                value: $parameters->order_by,
                callback: fn(Builder $builder, OrderParameterDTO $order_by) => $builder->orderBy($order_by->column, $order_by->direction)
            )
            ->when(
                value: $parameters->relations,
                callback: fn(Builder $builder, array $relations) => $builder->with($relations)
            )
            ->get();
    }

    public function create(SeasonDTO $payload): Season
    {
        $season = new Season($payload->toArray());
        $season->save();

        return $season;
    }

    public function update(Season $season, SeasonDTO $payload): Season
    {
        $season->fill($payload->toArray());
        $season->save();

        return $season;
    }

    public function updateDates(Season $season, Carbon $started_at, Carbon $finished_at): Season
    {
        $season->fill([
            'started_at' => $started_at,
            'finished_at' => $finished_at
        ]);
        $season->save();

        return $season;
    }
}
