<x-card :header="$title" loading='save'>
    <form wire:submit='save' id='brand-form'>
         <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-4 gap-y-6" wire:init>
            <x-input label='Nome' wire:model='name'  />
               <x-select.styled
                label="Categorias"
                 multiple
                :options="$this->categoriesForSelect"
                wire:model="categories"
            />
        </div>
    </form>

    <x-slot:footer>
        <x-button link="{{ route('brands.index') }}" >Cancelar</x-button>
        <x-button form='brand-form' type='submit'>Salvar</x-button>
    </x-slot:footer>
</x-card>