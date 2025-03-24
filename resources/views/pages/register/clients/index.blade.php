<x-pages.index title='Listagem de Clientes'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('clients.create')">
                Novo Cliente
            </x-button>
        </x-slot>
        <x-card label="Clientes">
            <x-table :header="$header" :lines="$lines" :actions="$actions" />
            @if ($lines->hasPages())
                <x-slot name='footer'>
                    {{ $lines->links() }}
                </x-slot>
                
            @endif
          
        </x-card>

        <x-modal id='deleteModal'>
            <form class="form" :action="route" method="post">
                @csrf
                @method('DELETE')
                <x-card label="Excluir Cliente">


                    <p>Tem certeza que deseja excluir o cliente: <span x-text='name' class='font-bold'></span>?</p>

                    <x-slot name='footer'>
                        <x-button class="bg-red-500" @click="show = false">Cancelar</x-button>
                        <x-button class="bg-green-500" type=submit>Excluir</x-button>
                    </x-slot>
                </x-card>
            </form>
        </x-modal>

<x-action-message on="saved">
    
</x-action-message>
    </div>
</x-pages.index>
