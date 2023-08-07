<?php

namespace App\Traits;

use App\Contracts\Filterable;
use Illuminate\Database\Eloquent\Builder;

trait InteractsWithFilters
{
    public function scopeFilter(Builder $builder, array $filters): void
    {
        foreach ($this->filters as $class => $column) {
            $filter = new $class($column);

            if ($filter instanceof Filterable) {
                $filter->filter($builder, $filters);
            }
        }
    }
}
