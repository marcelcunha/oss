<x-pages.index title='Listagem de Equipamentos'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('devices.create')">
                Novo Equipamento
            </x-button>
        </x-slot>
        <x-card label="Equipamentos">

            <x-table :$columns :$rows :actions="$actions" />

            @if ($rows->hasPages())
                <x-slot name='footer'>
                    {{ $rows->links() }}
                </x-slot>
            @endif
        </x-card>

        <x-modal id='deleteModal'>
            <form class="form" :action="route" method="post">
                @csrf
                @method('DELETE')
                <x-card label="Excluir Tipo de Equipamento">


                    <p>Tem certeza que deseja excluir o equipamento: <span x-text='name' class='font-bold'></span>?</p>

                    <x-slot name='footer'>
                        <x-button class="btn-secondary" @click="show = false">Cancelar</x-button>
                        <x-button class="btn-primary" type=submit>Excluir</x-button>
                    </x-slot>
                </x-card>
            </form>
        </x-modal>

    </div>

</x-pages.index>
