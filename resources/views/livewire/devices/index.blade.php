<div>
    <x-toast />
    <x-card>
        <x-slot:header>
            <h1>Equipamentos</h1>
            <x-button
                href="{{ route('devices.create') }}"
                icon="plus"
                label="Novo Equipamento"
            />
        </x-slot:header>
        <x-table
            :$headers
            :rows="$this->rows"
            empty="Nenhum registro encontrado"
            paginate
            simple-pagination
        >
            @interact('column_actions', $row)
                <x-button
                    href="{{ route('devices.edit', $row->id) }}"
                    icon="pencil"
                    wire:click="delete('{{ $row->id }}')"
                />
                <x-button
                    icon="trash"
                    wire:click="delete('{{ $row->id }}')"
                />
            @endinteract
        </x-table>
    </x-card>
</div>
