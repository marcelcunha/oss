<?php

namespace App\Services;

use App\Enums\BrandCategoryEnum;
use App\Enums\DeviceTypeEnum;
use App\Models\Checkin;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CheckinService
{
    /**
     * @return array <string, mixed>
     */
    public function create(): array
    {
        $clients = Client::orderBy('name')->whereHas('devices')->pluck('name', 'id');
        $cpuBrands = BrandService::brandsForSelect(BrandCategoryEnum::CPU);
        $gpuBrands = BrandService::brandsForSelect(BrandCategoryEnum::GPU);
        $moboBrands = BrandService::brandsForSelect(BrandCategoryEnum::MOTHERBOARD);
        $ramBrands = BrandService::brandsForSelect(BrandCategoryEnum::RAM);
        $storageBrands = BrandService::brandsForSelect(BrandCategoryEnum::STORAGE);
        $psuplyBrands = BrandService::brandsForSelect(BrandCategoryEnum::POWERSUPPLY);

        return [
            'clients' => $clients,
            'cpuBrands' => $cpuBrands,
            'gpuBrands' => $gpuBrands,
            'moboBrands' => $moboBrands,
            'ramBrands' => $ramBrands,
            'storageBrands' => $storageBrands,
            'psuplyBrands' => $psuplyBrands,
            'acceptableTypes' => [DeviceTypeEnum::DESKTOP->value, DeviceTypeEnum::LAPTOP->value],
        ];
    }

    /**
     * @return array <string, mixed>
     */
    public function edit(Checkin $checkin): array
    {
        return [
            'checkin' => $checkin,
            ...$this->create(),
        ];
    }

    /**
     * @return array<string, mixed>
     *
     * @throws InvalidArgumentException
     */
    public function index(): array
    {
        $checkins = Checkin::query()
            ->with(['client', 'device.brand'])
            ->orderBy('date', 'desc')->paginate(10);

        return [
            'rows' => $checkins,
            'columns' => [
                'date' => [
                    'label' => 'Data',
                    'format' => 'date',
                ],
                'client.name' => 'Cliente',
                'device.name' => 'Dispositivo',
            ],
            'actions' => [
                'show' => 'checkins.show',
                // 'edit' => 'checkins.edit',
                // 'delete' => 'checkins.destroy',
            ],
        ];
    }

    public function remove(Checkin $checkin): void
    {
        DB::transaction(function () use ($checkin) {
            $checkin->configuration()->delete();
            $checkin->delete();
        });
    }

    /**
     * @param  array<string, string|list<string>>  $configuration
     */
    public function store(string|Carbon $date, int $client_id, int $device_id, string $description, array $configuration = []): Checkin
    {
        return DB::transaction(function () use ($date, $client_id, $device_id, $description, $configuration) {
            $checkin = Checkin::create([
                'date' => $date,
                'client_id' => $client_id,
                'device_id' => $device_id,
                'description' => $description,
            ]);

            if (filled($configuration)) {
                $checkin->configuration()->create([...$configuration, 'device_id' => $device_id]);
            }

            return $checkin;
        });
    }

    /**
     * @param  array<string, string|list<string>>  $configuration
     */
    public function update(Checkin $checkin, string $date, int $client_id, int $device_id, string $description, array $configuration = []): Checkin
    {
        return DB::transaction(function () use ($checkin, $date, $client_id, $device_id, $description, $configuration) {
            $checkin->update([
                'date' => $date,
                'client_id' => $client_id,
                'device_id' => $device_id,
                'description' => $description,
            ]);

            if (filled($configuration)) {
                $checkin->configuration()->update([...$configuration, 'device_id' => $device_id]);
            }

            return $checkin;
        });
    }
}
