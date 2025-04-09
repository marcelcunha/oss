<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'brand' => $this->brand->name,
            'model' => $this->model,
            'serial_number' => $this->serial_number,
            'service_tag' => $this->service_tag,
            'description' => $this->description,
            'client' => $this->client->name,
        ];
    }
}
