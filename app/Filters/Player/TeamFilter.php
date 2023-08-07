<?php

namespace App\Filters\Player;

use App\Contracts\Filterable;
use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class TeamFilter extends BaseFilter implements Filterable
{
    public function filter(Builder $builder, array $filters): void
    {
        $builder->when(
            value: isset($filters['team_id']),
            callback: fn(Builder $builder) => $builder->where(
                column: $this->column ?? 'team_id',
                operator: '=',
                value: $filters['team_id'])
        );
    }
}
