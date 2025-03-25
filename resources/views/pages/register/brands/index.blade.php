<x-pages.index title='Marcas'>
    <div x-data="{ show: false, name: '', route: '' }">
        <x-slot name='actions'>
            <x-button :href="route('brands.create')">
                Nova Marca
            </x-button>
        </x-slot>
        <x-card label="Marcas">
            <x-table :header="$header" :lines="$lines" :actions="$actions" />
            <x-slot name='footer'>
                {{ $lines->links() }}
            </x-slot>
        </x-card>

        <x-modal id='deleteModal'>
            <form class="form" :action="route" method="post">
                @csrf
                @method('DELETE')
                <x-card label="Excluir Marca">


                    <p>Tem certeza que deseja excluir a marca: <span x-text='name' class='font-bold'></span>?</p>

                    <x-slot name='footer'>
                        <x-button color='secondary' @click="show = false">Cancelar</x-button>
                        <x-button  type=submit>Excluir</x-button>
                    </x-slot>
                </x-card>
            </form>
        </x-modal>
    </div>
</x-pages.index>
