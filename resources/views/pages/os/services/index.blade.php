<x-pages.index title='Serviços'>
    <div>

        <x-card label="Serviços">
            {{-- <x-table :$columns :$rows :actions="$actions">
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
            </x-slot> --}}
        </x-card>
</x-pages.index>
