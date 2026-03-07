<x-side-bar collapsible navigate thin-scroll>
   

    {{-- <x-side-bar.separator text="Cadastros" /> --}}
    {{-- <x-side-bar.item text="Listar Cadastros" :route="route('cadastros.index')"  /> --}}
    <x-side-bar.item text="Clientes" :route="route('clients.index')"  />
    <x-side-bar.item text="Equipamentos" :route="route('devices.index')"  />
    <x-side-bar.item text="Marcas" :route="route('brands.index')"  />

</x-side-bar>