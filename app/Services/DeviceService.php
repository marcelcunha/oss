<?php

namespace App\Services;

use App\Enums\DeviceTypeEnum;
use App\Models\Client;
use App\Models\Device;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class DeviceService
{
    /**
     * @return array<string, mixed>
     */
    public function create(): array
    {
        return [
            'clients' => Client::orderBy('name')->pluck('name', 'id'),
            'types' => self::deviceTypesForSelect(),
            'brands' => BrandService::brandsForSelect(),
        ];
    }

    /**
     * @return Collection<int, Device>
     */
    public static function devices(?int $clientId = null): Collection
    {
        return Device::query()
            ->with('brand')
            ->when($clientId, fn($query) => $query->where('client_id', $clientId))
            ->get();
    }

    /**
     * @return Collection<int, string>
     */
    public static function devicesForSelect(?int $clientId = null): Collection
    {
        return self::devices($clientId)
            ->mapWithKeys(
                function (Device $device) {

                    return [
                        $device->id => $device->name,
                    ];
                }
            );
    }

    /**
     * @return array<string, mixed>
     *
     * @throws InvalidArgumentException
     */
    public function edit(Device $device): array
    {
        return [
            'device' => $device,
            ...$this->create(),
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function deviceTypesForSelect(): array
    {
        return Arr::mapWithKeys(DeviceTypeEnum::cases(), function (DeviceTypeEnum $type) {
            return [$type->value => $type->label()];
        });
    }
}
