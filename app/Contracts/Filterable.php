<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filterable
{
    public function filter(Builder $builder, array $filters): void;
}
