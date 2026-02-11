<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GovernmentAreaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'responsible_name' => $this->responsible_name,
            'responsible_position' => $this->responsible_position,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'schedule' => $this->schedule,
        ];
    }
}
