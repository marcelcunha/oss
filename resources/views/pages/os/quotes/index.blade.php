<x-pages.index title='Entradas de Orçamento'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('quotes.create')">
                Nova Entrada
            </x-button>
        </x-slot>

        <x-card label="Entradas">
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
            @if ($rows->hasPages())
                <x-slot name='footer'>
                    {{ $rows->links() }}
                </x-slot>
            @endif
        </x-card>
</x-pages.index>
