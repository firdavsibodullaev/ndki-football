<?php

namespace App\Http\Resources;

use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Season $resource
 */
class SeasonResource extends JsonResource
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
            'name' => $this->resource->name,
            'started_at' => $this->resource->started_at,
            'finished_at' => $this->resource->finished_at,
            'tournament' => TournamentResource::make($this->whenLoaded('tournament')),
            'teams' => SeasonTeamResource::collection($this->whenLoaded('seasonTeams'))
        ];
    }
}
