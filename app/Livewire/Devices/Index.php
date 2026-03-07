<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public array $headers = [
        ['index' => 'type', 'label' => 'Tipo'],
        ['index' => 'model', 'label' => 'Modelo'],
        ['index' => 'serial_number', 'label' => 'Serial'],
        ['index' => 'service_tag', 'label' => 'Tag de Serviço'],
        ['index' => 'brand.name', 'label' => 'Marca'],
        ['index' => 'client.name', 'label' => 'Cliente'],
        ['index' => 'actions', 'label' => 'Ações'],
    ];

    public int $perPage = 10;

    public function render()
    {
        return view('livewire.devices.index');
    }

    #[Computed()]
    public function rows(): LengthAwarePaginator
    {
        return Device::query()
            ->with(['brand', 'client'])
            ->orderBy('model')
            ->paginate($this->perPage);
    }
}
