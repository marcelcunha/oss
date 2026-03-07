<?php

namespace App\Livewire\Brands;

use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Ramsey\Collection\Collection;

class Index extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.brands.index');
    }

    #[Computed()]
    public function rows():LengthAwarePaginator{
        return Brand::query()
            ->orderBy('name')
            ->paginate();
    }
}
