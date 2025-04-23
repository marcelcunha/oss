<x-pages.show :backRoute="route('budgets.index')" title='Orçamento' x-data="{ show: false }">

    <x-slot:actions>
        <div class="flex gap-x-2">
        
            <x-button :href="route('budgets.edit', $budget->id)" btn='btn-xs' class='h-8' color=secondary title='Editar'>
                <x-heroicon-o-pencil class='w-5' />
            </x-button>
            <x-button @click="show=true" btn='btn-xs' class='h-8' color=secondary title='Remover'>
                <x-heroicon-o-trash class='w-5' />
            </x-button>
        </div>
    </x-slot:actions>

    <div class="grid gap-x-4 gap-y-6 lg:grid-cols-3 2xl:grid-cols-3">
        <x-input-text label='Cliente' readonly value="{{ $budget->checkin->client->name }}" />
        <x-input-text label='Equipamento' readonly value="{{ $budget->checkin->device->name }}" />
        <x-input-text label='Data do Orçamento' name='budget_date' readonly
            value="{{ $budget->budget_date->format('d/m/Y') }}" />

        <x-input-text label='Status' readonly value="{{ $budget->status->label() }}" />
        <x-input-text label='Valor Total' readonly
            value="{{ number_format($budget->total, 2, ',', '.') }}">
            <x-slot:prefix>
                R$
            </x-slot:prefix>
        </x-input-text>

        <x-textarea label='Anotações' name='notes' parent-class='col-span-3 mb-6' readonly
            value="{{ $budget->notes }}" />
    </div>

    <x-card label='Ítens do Orçamento'>

        <div class="mt-2">
            <x-table :columns="['Descrições', 'Preços']" border>
                @foreach ($budget->items as $item)
                    <tr>
                        <td class="p-2">
                            {{ $item->description }}
                        </td>
                        <td class="p-2">
                            R$ {{ number_format($item->price, 2, ',', '.') }}
                        </td>

                    </tr>
                @endforeach

                <x-slot:footer>
                    <tr class='text-left'>
                        <th class='p-2'>Total:</th>
                        <th class="p-2 " colspan="2">
                             R$ {{ number_format($budget->total, 2, ',', '.') }}
                        </th>
                    </tr>
                </x-slot:footer>

            </x-table>

        </div>

    </x-card>

    <x-modal id='deleteModal'>
        <form action="{{ route('budgets.destroy', $budget->id) }}" class="form" method="post">
            @csrf
            @method('DELETE')
            <x-card label="Excluir Orçamento">
                <p>Tem certeza que deseja excluir esse orçamento?</p>
                <x-slot name='footer'>
                    <x-button @click="show = false" color='secondary'>Cancelar</x-button>
                    <x-button type=submit>Excluir</x-button>
                </x-slot>
            </x-card>
        </form>
    </x-modal>
</x-pages.show>
