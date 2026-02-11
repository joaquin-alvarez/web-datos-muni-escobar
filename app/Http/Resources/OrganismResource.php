<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganismResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'description' => $this->description,
            'functions' => $this->functions,
            'head_name' => $this->head_name,
            'head_position' => $this->head_position,
            'children' => OrganismResource::collection($this->whenLoaded('children')),
        ];
    }
}
