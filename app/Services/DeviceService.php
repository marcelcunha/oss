<?php

namespace App\Services;

use App\Enums\DeviceTypeEnum;
use App\Models\Client;
use App\Models\Device;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DeviceService
{
    public function create(): array
    {
        return [
            'clients' => Client::orderBy('name')->pluck('name', 'id'),
            'types' => $this->deviceTypesForSelect(),
            'brands' => BrandService::brandsForSelect(),
        ];
    }

    public static function devices(?int $clientId = null): Collection
    {
        return Device::query()
            ->with('brand')
            ->when($clientId, fn ($query) => $query->where('client_id', $clientId))
            ->get();
    }

    public static function devicesForSelect(?int $clientId = null): Collection
    {
        return self::devices($clientId)
            ->mapWithKeys(
                function (Device $device) {
                    $name = $device->brand->name;

                    if ($device->model) {
                        $name .= ' - '.$device->model;
                    }

                    return [
                        $device->id => $device->brand->name.' '.$device->model,
                    ];
                }
            );
    }

    public function edit(Device $device): array
    {
        return [
            'device' => $device,
            ...$this->create(),
        ];
    }

    private function deviceTypesForSelect(): array
    {
        return Arr::mapWithKeys(DeviceTypeEnum::cases(), function (DeviceTypeEnum $type) {
            return [$type->value => $type->label()];
        });
    }
}
