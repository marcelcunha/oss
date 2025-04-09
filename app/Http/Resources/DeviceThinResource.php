<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceThinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $description = $this->brand->name;

        if ($this->model) {
            $description .= ' - '.$this->model;
        }

        return [
            'id' => $this->id,
            'description' => $description,
        ];
    }
}
