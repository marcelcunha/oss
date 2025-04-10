<x-pages.index title='Checkin'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('checkins.create')">
                Novo Checkin
            </x-button>
        </x-slot>

        <x-card label="Checkin">
            <x-table :$columns :$rows :actions="$actions">
             
            </x-table>
            <x-slot name='footer'>
                {{ $rows->links() }}
            </x-slot>
        </x-card>
</x-pages.index>