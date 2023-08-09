<?php

namespace App\Http\Resources;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property-read Team $resource */
class TeamResource extends JsonResource
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
            'logo' => $this->whenLoaded('logo', fn() => [
                'url' => $this->resource->logo->getFullUrl(),
                'filename' => $this->resource->logo->file_name
            ]),
        ];
    }
}
