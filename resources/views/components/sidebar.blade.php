<x-side-bar
    collapsible
    navigate
    thin-scroll
>

    {{-- <x-side-bar.separator text="Cadastros" /> --}}
    {{-- <x-side-bar.item text="Listar Cadastros" :route="route('cadastros.index')"  /> --}}
    <x-side-bar.item text="Cadastros">

        <x-side-bar.item
            :route="route('clients.index')"
            text="Clientes"
        />
        <x-side-bar.item
            :route="route('devices.index')"
            text="Equipamentos"
        />
        <x-side-bar.item
            :route="route('brands.index')"
            text="Marcas"
        />
    </x-side-bar.item>

</x-side-bar>
