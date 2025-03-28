<x-pages.index title='Listagem de Tipo de Equipamentos'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('device_types.create')">
                Novo Tipo de Equipamento
            </x-button>
        </x-slot>
        <x-card label="Tipos de Equipamentos">
            <x-table :$rows :$columns :actions="$actions" />
            <x-slot name='footer'>
                {{ $rows->links() }}
            </x-slot>
        </x-card>

        <x-modal id='deleteModal'>
            <form class="form" :action="route" method="post">
                @csrf
                @method('DELETE')
                <x-card label="Excluir Tipo de Equipamento">


                    <p>Tem certeza que deseja excluir o tipo: <span x-text='name' class='font-bold'></span>?</p>

                    <x-slot name='footer'>
                        <x-button class="bg-red-500" @click="show = false">Cancelar</x-button>
                        <x-button class="bg-green-500" type=submit>Excluir</x-button>
                    </x-slot>
                </x-card>
            </form>
        </x-modal>

    </div>
</x-pages.index>
