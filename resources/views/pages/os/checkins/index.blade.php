<x-pages.index title='Checkin'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('checkins.create')">
                Novo Checkin
            </x-button>
        </x-slot>

        <x-card label="Checkin">
            <x-table :$columns :$rows :actions="$actions">
                @scope('cell', $row)
                    @if ($row->budget()->exists())
                        <x-badge color='primary'>
                            Orçamento
                        </x-badge>
                    @else
                        <x-badge>
                            Criado
                        </x-badge>
                    @endif
                @endscope
            </x-table>
            <x-slot name='footer'>
                {{ $rows->links() }}
            </x-slot>
        </x-card>
</x-pages.index>
