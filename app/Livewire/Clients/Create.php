<?php

namespace App\Livewire\Clients;

use App\Services\ClientService;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;

    public string $address = '';

    public string $complement = '';

    public string $name = '';

    public ?int $num = null;

    public string $phone = '';

    public string $title = 'Criar Cliente';

    public function render()
    {
        return view('livewire.clients.create');
    }

    public function save(ClientService $service)
    {
        $this->validate([
            'name' => ['required', 'string', 'max:60'],
            'phone' => ['nullable', 'string', 'max:16'],
            'address' => ['nullable', 'string', 'max:60'],
            'num' => ['nullable', 'integer'],
            'complement' => ['nullable', 'string', 'max:60'],
        ]);

        $this->toast()->success('Cliente criado com sucesso!')->flash()->send();
        $this->resetExcept('title');
        $this->redirectRoute('clients.index');
    }
}
