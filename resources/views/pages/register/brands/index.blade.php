<x-pages.index title='Marcas'>
    <x-slot name='actions'>
        <x-button :href="route('brands.create')">
            Nova Marca
        </x-button>
    </x-slot>
    <x-card label="Marcas">
        <x-table :header="$header" :lines="$lines" />
        <x-slot name='footer'>
            {{ $lines->links() }}
        </x-slot>
    </x-card>
</x-pages.index>