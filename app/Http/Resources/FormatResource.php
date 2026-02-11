<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'extension' => $this->extension,
            'color' => $this->color,
            'pivot' => $this->whenPivotLoaded('dataset_format', fn () => [
                'file_name' => $this->pivot->file_name,
                'file_url' => $this->pivot->file_url,
                'file_size' => $this->pivot->file_size,
            ]),
        ];
    }
}
