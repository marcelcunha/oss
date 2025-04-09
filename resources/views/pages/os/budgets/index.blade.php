<x-pages.index title='Orçamentos'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('budgets.create')">
                Novo Orçamento
            </x-button>
        </x-slot>

        <x-card label="Orçamentos">
            <x-table :$columns :$rows :actions="$actions">
             
            </x-table>
            <x-slot name='footer'>
                {{ $rows->links() }}
            </x-slot>
        </x-card>
</x-pages.index>