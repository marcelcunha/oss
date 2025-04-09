<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

/**
 * @template TKey of array-key
 * @template TValue
 */
class Table extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  array<string, string|array<string, string>>  $columns
     * @param  LengthAwarePaginator<Collection<TKey, TValue>>  $rows
     * @param  array<string, string>  $actions
     */
    public function __construct(
        public array $columns,
        public LengthAwarePaginator $rows,
        public ?string $parentClass = null,
        public ?string $id = null,
        public array $actions = [],
        private bool $simple = true,
    ) {}

    public function formatCell(string $column, mixed $row): string
    {
        $value = data_get($row, $column, '');

        if (is_array($this->columns[$column])) {
            $format = data_get($this->columns[$column], 'format', false);

            return match ($format) {
                'date' => Carbon::parse($value)->format('d/m/Y'),
                'money' => 'R$ '.number_format($value, 2, ',', '.'),
                'enum' => $value->label(),
                default => $value,
            };

        }

        return $value;
    }

    /**
     * @return list<string>
     */
    public function getColumns(): array
    {
        return array_keys($this->columns);
    }

    /**
     * @return list<string>
     */
    public function getTitles(): array
    {
        $titles = [];
        foreach ($this->columns as $column) {
            if (is_array($column)) {
                $titles[] = $column['label'];
                $this->simple = false;
            } else {
                $titles[] = $column;
            }
        }

        return $titles;
    }

    public function isCustomCell(string $column): bool
    {
        if (! $this->simple) {
            if ($this->columns[$column]['custom'] ?? false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }

    public function totalColumns(): int
    {
        $total = count($this->columns);

        if (count($this->actions) > 0) {
            $total++;
        }

        return $total;
    }
}
