<?php

namespace App\Services;

use App\Contracts\Season\SeasonRepositoryInterface;
use App\Contracts\Season\SeasonServiceInterface;
use App\DTOs\Season\OrderParameterDTO;
use App\DTOs\Season\SeasonDTO;
use App\DTOs\Season\SeasonParametersDTO;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

class SeasonService implements SeasonServiceInterface
{
    public function __construct(
        private readonly SeasonRepositoryInterface $seasonRepository
    )
    {
    }

    public function getListLastFirstWithCache(): Collection
    {
        return $this->seasonRepository->get(
            parameters: SeasonParametersDTO::make(
                order_by: OrderParameterDTO::make(
                    column: 'started_at',
                    direction: 'desc')
            )
        );
    }

    public function createAndClearCache(SeasonDTO $payload): Season
    {
        return $this->seasonRepository->create($payload);
    }

    public function updateAndClearCache(Season $season, SeasonDTO $payload): Season
    {
        return $this->seasonRepository->update($season, $payload);
    }
}
