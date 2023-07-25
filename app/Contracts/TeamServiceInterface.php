<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface TeamServiceInterface
{
    public function fetchActive(): Collection;
}
