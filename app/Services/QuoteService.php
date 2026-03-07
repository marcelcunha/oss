<?php

namespace App\Services;

use App\DTOs\QuoteDTO;
use App\Enums\BrandCategoryEnum;
use App\Enums\DeviceTypeEnum;
use App\Enums\QuoteStatusEnum;
use App\Models\Client;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class QuoteService
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
            'date' => now()->format('Y-m-d'),
            'acceptableTypes' => [
                DeviceTypeEnum::DESKTOP->value,
                DeviceTypeEnum::LAPTOP->value,
            ],
        ];
    }

    public function delete(Quote $budget): void
    {
        DB::transaction(function () use ($budget) {
            $budget->items()->delete();
            $budget->delete();
        });
    }

    /**
     * @return array{
     *     budget: Quote,
     *    items: array<array{
     *       description: string,
     *      price: int,
     *     }>
     * }
     */
    public function edit(Quote $budget): array
    {
        $items = $budget->items->map(function (QuoteItem $item): array {
            return [
                'description' => $item->description,
                'price' => $item->price,
            ];
        })->toArray();

        return [
            'budget' => $budget->load(['checkin.client', 'checkin.device.brand']),
            'items' => $items,

        ];
    }

    /**
     * @return array{
     *      rows: LengthAwarePaginator<Quote>,
     *      columns: array<string,array<string,string>>,
     *      actions: array<string,string>,
     *     }
     */
    public function index(): array
    {
        return [
            'rows' => Quote::with(['checkin.client', 'checkin.device.brand', 'items'])->orderBy('budget_date', 'desc')->paginate(10),
            'columns' => [
                'budget_date' => ['label' => 'Data do orçamento', 'format' => 'date'],
                'checkin.client.name' => ['label' => 'Cliente'],
                'checkin.device.name' => ['label' => 'Dispositivo'],
                'total' => ['label' => 'Valor', 'format' => 'money'],
                'status' => ['label' => 'Status', 'custom' => true],
            ],
            'actions' => [
                'show' => 'quotes.show',
            ],
        ];
    }

    public function store(QuoteDTO $dto): Quote
    {
        return DB::transaction(function () use ($dto) {
            $items = $dto->items;

            $budget = Quote::create([
                ...$dto->toArray(),
                'status' => QuoteStatusEnum::PENDING->value,
            ]);

            foreach ($items as $item) {
                $budget->items()->create($item);
            }

            return $budget;
        });
    }

    /**
     * @param  array<array{
     *      description: string,
     *      price: int,
     *     }>  $items
     */
    public function update(Quote $budget, string $budget_date, array $items, ?string $notes = null): Quote
    {
        return DB::transaction(function () use ($budget, $budget_date, $items, $notes) {
            $budget->update([
                'budget_date' => $budget_date,
                'notes' => $notes,
            ]);

            foreach ($items as $item) {
                $budget->items()->updateOrCreate(
                    [
                        'description' => $item['description'],
                    ],
                    $item
                );
            }

            return $budget;
        });
    }
}
