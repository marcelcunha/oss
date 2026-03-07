<?php

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;

class DeviceConfigurationDTO implements Arrayable
{
    public function __construct(
        public string $os,
        public int $device_id,
        public array $cpu,
        public ?array $motherboard = null,
        public array $memory,
        public ?array $storage = null,
        public ?array $gpu = null,
        public ?array $power_supply = null,
        public ?string $notes = null
    ) {}

    public function toArray()
    {
        return [
            'os' => $this->os,
            'cpu' => $this->cpu,
            'mobo' => $this->motherboard,
            'memory' => $this->memory,
            'storage' => $this->storage,
            'gpu' => $this->gpu,
            'power_supply' => $this->power_supply,
            'device_id' => $this->device_id,
            'notes' => $this->notes,
        ];
    }
}
