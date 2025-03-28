<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $columns,
        public LengthAwarePaginator $rows,
        public ?string $parentClass = null,
        public ?string $id = null,
        public array $actions = [],
        private bool $simple = true,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }

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

    public function getColumns(): array
    {
        return array_keys($this->columns);
    }

    public function totalColumns(): int
    {
        $total = count($this->columns);

        if (count($this->actions) > 0) {
            $total++;
        }

        return $total;
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
}
