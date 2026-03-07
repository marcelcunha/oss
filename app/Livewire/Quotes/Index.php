<?php

namespace App\Livewire\Quotes;

use App\Models\Quote;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public array $headers = [
        ['index' => 'client_id', 'label' => 'Cliente'],
        ['index' => 'quote_date', 'label' => 'Data'],
        ['index' => 'status', 'label' => 'Status'],
        ['index' => 'total', 'label' => 'Valor'],
        ['index' => 'notes', 'label' => 'Notas'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public int $perPage = 10;

    public function render()
    {
        return view('livewire.quotes.index');
    }

    #[Computed()]
    public function rows(): LengthAwarePaginator
    {
        return Quote::query()
            ->orderBy('quote_date', 'desc')
            ->paginate($this->perPage);
    }
}
