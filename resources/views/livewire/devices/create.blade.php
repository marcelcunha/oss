<x-card :header="$title" loading='save'>
    <form wire:submit='save' id='device-form'>
         <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-4 gap-y-6" wire:init>
            <x-input label='Tipo' wire:model='type'  />
            <x-input label='Modelo' wire:model='model'  />
            <x-input label='Serial' wire:model='serial_number'  />
            <x-input label='Tag de Serviço' wire:model='service_tag'  />
            <x-input label='Descrição' wire:model='description'  />
            <x-select.styled label='Marca' :options="$this->brandsForSelect" wire:model='brand_id' />
            <x-select.styled label='Cliente' :options="$this->clientsForSelect" wire:model='client_id' />
        </div>
    </form>

    <x-slot:footer>
        <x-button link="{{ route('devices.index') }}" >Cancelar</x-button>
        <x-button form='device-form' type='submit'>Salvar</x-button>
    </x-slot:footer>
</x-card>
