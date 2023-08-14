<?php

namespace App\Http\Resources;

use App\Models\SeasonTeam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read SeasonTeam $resource
 */
class SeasonTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'points' => $this->resource->points,
            'goals_scored' => $this->resource->goals_scored,
            'goals_conceded' => $this->resource->goals_conceded,
            'team' => TeamResource::make($this->whenLoaded('team')),
            'season' => SeasonResource::make($this->whenLoaded('season'))
        ];
    }
}
