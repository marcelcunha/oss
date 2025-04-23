<?php

namespace App\Services;

use App\Enums\BudgetStatusEnum;
use App\Models\Budget;
use App\Models\BudgetItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BudgetService
{
    public function delete(Budget $budget): void
    {
        DB::transaction(function () use ($budget) {
            $budget->items()->delete();
            $budget->delete();
        });
    }

    /**
     * @return array{
     *     budget: Budget,
     *    items: array<array{
     *       description: string,
     *      price: int,
     *     }>
     * }
     */
    public function edit(Budget $budget): array
    {
        $items = $budget->items->map(function (BudgetItem $item): array {
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
     *      rows: LengthAwarePaginator<Budget>,
     *      columns: array<string,array<string,string>>,
     *      actions: array<string,string>,
     *     }
     */
    public function index(): array
    {
        return [
            'rows' => Budget::with(['checkin.client', 'checkin.device.brand', 'items'])->orderBy('budget_date', 'desc')->paginate(10),
            'columns' => [
                'budget_date' => ['label' => 'Data do orçamento', 'format' => 'date'],
                'checkin.client.name' => ['label' => 'Cliente'],
                'checkin.device.name' => ['label' => 'Dispositivo'],
                'total' => ['label' => 'Valor', 'format' => 'money'],
                'status' => ['label' => 'Status', 'format' => 'enum'],
            ],
            'actions' => [
                'show' => 'budgets.show',
            ],
        ];
    }

    /**
     * @param  array<array{
     *      description: string,
     *      price: int,
     *     }>  $items
     */
    public function store(int $checkin_id, string $budget_date, array $items, ?string $notes = null): Budget
    {
        return DB::transaction(function () use ($checkin_id, $budget_date, $items, $notes) {
            $budget = Budget::create([
                'checkin_id' => $checkin_id,
                'budget_date' => $budget_date,
                'notes' => $notes,
                'status' => BudgetStatusEnum::PENDING,
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
    public function update(Budget $budget, string $budget_date, array $items, ?string $notes = null): Budget
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
