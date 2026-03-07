<x-pages.upsert title='Nova Marca'>
    <x-form
     wire:submit.prevent="submit"
        id='brand-form'
    >
        <div class="grid gap-x-4 gap-y-6 lg:grid-cols-2 2xl:grid-cols-3">
            <x-input-text
                label='Nome'
                name='name'
                value="{{ old('name') }}"
            />

         
        </div>
    </x-form>

</x-pages.upsert>
