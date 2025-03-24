<x-pages.show title='Equipamento' :subtitle="$device->model" :backRoute="route('devices.index')">

    <div class="grid lg:grid-cols-6 gap-x-4 gap-y-6">
        <x-input-text readonly value="{{ $device->client->name }}" label='Proprietário' parent-class='col-span-4' />
        <x-input-text readonly value="{{ $device->type->name }}" label='Tipo' />
        <x-input-text readonly value="{{ $device->brand->name }}" label='Marca' />

        <x-input-text readonly value="{{ $device->model }}" parent-class='col-span-2' label='Modelo' />
        <x-input-text readonly value="{{ $device->serial_number }}" parent-class='col-span-2' label='Serial' />
        <x-input-text readonly value="{{ $device->service_tag }}" parent-class='col-span-2' label='Tag de Serviço' />

        <x-textarea readonly value="{{ $device->description }}" label='Descrição'
            parent-class='col-span-6'></x-textarea>
    </div>

</x-pages.show>
