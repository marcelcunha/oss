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
            'id' => $this->resource->id,
            'type' => $this->resource->type,
            'brand' => $this->resource->brand->name,
            'model' => $this->resource->model,
            'serial_number' => $this->resource->serial_number,
            'service_tag' => $this->resource->service_tag,
            'description' => $this->resource->description,
            'client' => $this->resource->client->name,
        ];
    }
}
