<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DatasetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'organization' => $this->organization,
            'metadata' => [
                'version' => $this->version,
                'periodicity' => $this->periodicity,
                'source' => $this->source,
                'license' => $this->license,
                'created_date' => $this->created_date?->toIso8601String(),
                'last_modified' => $this->last_modified?->toIso8601String(),
            ],
            'formats' => FormatResource::collection($this->whenLoaded('formats')),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
