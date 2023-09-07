<?php

namespace App\Http\Resources;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Game $resource
 */
class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'home' => [
                'season_team' => SeasonTeamResource::make($this->whenLoaded('home')),
                'goals' => $this->resource->home_goals
            ],
            'away' => [
                'season_team' => SeasonTeamResource::make($this->whenLoaded('away')),
                'goals' => $this->resource->away_goals
            ],
            'game_at' => $this->resource->game_at,
            'round' => $this->resource->round,
            'status' => $this->resource->status->translate(),
            'season' => SeasonResource::make($this->whenLoaded('season'))
        ];
    }
}
