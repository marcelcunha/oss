<?php

namespace App\Livewire\Brands;

use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public array $headers = [
        ['index' => 'name', 'label' => 'Nome'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public int $perPage = 10;

    public function render()
    {
        return view('livewire.brands.index');
    }

    #[Computed()]
    public function rows(): LengthAwarePaginator
    {
        return Brand::query()
            ->orderBy('name')
            ->paginate($this->perPage);
    }
}
