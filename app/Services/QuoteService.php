<?php

namespace App\Services;

use App\Enums\QuoteStatusEnum;
use App\Models\QuoteItem;
use App\Models\Quote;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class QuoteService
{
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

    /**
     * @param  array<array{
     *      description: string,
     *      price: int,
     *     }>  $items
     */
    public function store(int $checkin_id, string $budget_date, array $items, ?string $notes = null): Quote
    {
        return DB::transaction(function () use ($checkin_id, $budget_date, $items, $notes) {
            $budget = Quote::create([
                'checkin_id' => $checkin_id,
                'budget_date' => $budget_date,
                'notes' => $notes,
                'status' => QuoteStatusEnum::PENDING,
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
