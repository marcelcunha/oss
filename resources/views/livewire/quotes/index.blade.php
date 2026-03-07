<x-toast />
<div>
    <x-card>
        <x-slot:header>
            <h1>Orçamentos</h1>
            <x-button
                href="{{ route('quotes.create') }}"
                icon="plus"
                label="Novo Orçamento"
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
                    href="{{ route('quotes.edit', $row->id) }}"
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
