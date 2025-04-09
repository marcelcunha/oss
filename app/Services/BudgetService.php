<?php

namespace App\Services;

use App\Enums\BrandCategoryEnum;
use App\Enums\DeviceTypeEnum;
use App\Models\Budget;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class BudgetService
{
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
    public function edit(Budget $budget): array
    {
        return [
            'budget' => $budget,
            ...$this->create()
        ];
    }

    public function index(): array
    {
        $budgets = Budget::query()
        ->with(['client', 'device.brand'])
        ->orderBy('date', 'desc')->paginate(10);

        return [
            'rows' => $budgets,
            'columns' => [
                'date' => [
                    'label' => 'Data',
                    'format' => 'date',
                ],
                'client.name' => 'Cliente',
                'device.name' => 'Dispositivo',
            ],
            'actions' => [
                'show' => 'budgets.show',
                // 'edit' => 'budgets.edit',
                // 'delete' => 'budgets.destroy',
            ],
        ];
    }

    public function remove(Budget $budget): void
    {
        DB::transaction(function () use ($budget) {
            $budget->configuration()->delete();
            $budget->delete();
        });
    }

    public function store(string $date, int $client_id, int $device_id, string $description, array $configuration = []): Budget
    {
        return DB::transaction(function () use ($date, $client_id, $device_id, $description, $configuration) {
            $budget = Budget::create([
                'date' => $date,
                'client_id' => $client_id,
                'device_id' => $device_id,
                'description' => $description,
            ]);

            if (filled($configuration)) {
                $budget->configuration()->create([...$configuration, 'device_id' => $device_id]);
            }

            return $budget;
        });
    }
    public function update(Budget $budget, string $date, int $client_id, int $device_id, string $description, array $configuration = []): Budget
    {
        return DB::transaction(function () use ($budget, $date, $client_id, $device_id, $description, $configuration) {
            $budget->update([
                'date' => $date,
                'client_id' => $client_id,
                'device_id' => $device_id,
                'description' => $description,
            ]);

            if (filled($configuration)) {
                $budget->configuration()->update([...$configuration, 'device_id' => $device_id]);
            }

            return $budget;
        });
    }
}
