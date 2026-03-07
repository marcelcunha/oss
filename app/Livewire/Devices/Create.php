<?php

namespace App\Livewire\Devices;

use App\Services\DeviceService;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;

    public ?int $brand_id = null;

    public ?int $client_id = null;

    public string $description = '';

    public string $model = '';

    public string $serial_number = '';

    public string $service_tag = '';

    public string $title = 'Criar Equipamento';

    public string $type = '';

    public function render()
    {
        return view('livewire.devices.create');
    }

    public function save(DeviceService $service)
    {
        $this->validate([
            'type' => ['required', 'string', 'max:30'],
            'model' => ['nullable', 'string', 'max:50'],
            'serial_number' => ['nullable', 'string', 'max:50'],
            'service_tag' => ['nullable', 'string', 'max:30'],
            'description' => ['nullable', 'string'],
            'brand_id' => ['required', 'integer'],
            'client_id' => ['required', 'integer'],
        ]);

        $this->toast()->success('Equipamento criado com sucesso!')->flash()->send();
        $this->resetExcept('title');
        $this->redirectRoute('devices.index');
    }
}
