<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public array $headers = [
        ['index' => 'name', 'label' => 'Nome'],
        ['index' => 'phone', 'label' => 'Telefone'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public int $perPage = 10;

    public function render()
    {
        return view('livewire.clients.index');
    }

    #[Computed()]
    public function rows(): LengthAwarePaginator
    {
        return Client::query()
            ->orderBy('name')
            ->paginate($this->perPage);
    }
}
