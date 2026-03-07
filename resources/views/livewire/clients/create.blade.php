<x-card :header="$title" loading='save'>
    <form wire:submit='save' id='client-form'>
         <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-4 gap-y-6" wire:init>
            <x-input label='Nome' wire:model='name'  />
            <x-input label='Telefone' wire:model='phone'  />
            <x-input label='Endereço' wire:model='address'  />
            <x-input label='Número' wire:model='num'  />
            <x-input label='Complemento' wire:model='complement'  />
        </div>
    </form>

    <x-slot:footer>
        <x-button link="{{ route('clients.index') }}" >Cancelar</x-button>
        <x-button form='client-form' type='submit'>Salvar</x-button>
    </x-slot:footer>
</x-card>
