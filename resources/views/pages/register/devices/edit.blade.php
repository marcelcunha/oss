<x-pages.upsert title='Editar Equipamento'>
    <x-form action="{{ route('devices.update', $device) }}" cancelRoute="{{ route('devices.index') }}" update>
       
        <div class="grid lg:grid-cols-6 gap-x-4 gap-y-6">
            <x-select value="{{ old('client_id', $device->client_id) }}" label='Proprietário' parent-class='col-span-4'
                name='client_id' :options="$clients" placeholder='Selecione' />
            <x-select value="{{ old('type', $device->type->value) }}" label='Tipo' name='type' :options="$types"
                placeholder='Selecione' />
            <x-select value="{{ old('brand_id', $device->brand_id) }}" label='Marca' name='brand_id' :options="$brands"
                placeholder='Selecione' />

            <x-input-text value="{{ old('model', $device->model) }}" parent-class='col-span-2' label='Modelo'
                name='model' />
            <x-input-text value="{{ old('serial_number', $device->serial_number) }}" parent-class='col-span-2'
                label='Serial' name='serial_number' />
            <x-input-text value="{{ old('service_tag', $device->service_tag) }}" parent-class='col-span-2'
                label='Tag de Serviço' name='service_tag' />

            <x-textarea value="{{ old('description', $device->description) }}" label='Descrição'
                parent-class='col-span-6'></x-textarea>
        </div>
    </x-form>
</x-pages.upsert>
