<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'position' => $this->position,
            'rank' => $this->rank,
            'area' => $this->area,
            'biography' => $this->biography,
            'photo_url' => $this->photo_url,
            'cv_url' => $this->cv_url,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_intendente' => $this->is_intendente,
            'is_cabinet' => $this->is_cabinet,
        ];
    }
}
