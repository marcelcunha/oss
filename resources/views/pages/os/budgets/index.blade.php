<x-pages.index title='Orçamentos'>
    <div x-data="{ show: false, name: '', route: '' }">

        <x-card label="Orçamentos">
            <x-table :$columns :$rows :actions="$actions">

            </x-table>
            
            @if ($rows->hasPages())
                <x-slot name='footer'>
                    {{ $rows->links() }}
                </x-slot>
            @endif
        </x-card>
</x-pages.index>
