<x-pages.upsert title='Novo Equipamento'>
    <x-form action="{{ route('devices.store') }}" cancelRoute="{{ route('devices.index') }}">
        <div>
            <div class="grid lg:grid-cols-6 gap-x-4 gap-y-6">
                <x-select value="{{ old('client_id') }}" label='Proprietário' parent-class='col-span-4' name='client_id'
                    :options="$clients" placeholder='Selecione' />
                <x-select value="{{ old('type_id') }}" label='Tipo' name='type_id' :options="$types" x-model='type'
                    placeholder='Selecione' />
                <x-select value="{{ old('brand_id') }}" label='Marca' name='brand_id' :options="$brands"
                    placeholder='Selecione' />
                <x-input-text value="{{ old('model') }}" parent-class='col-span-2' label='Modelo' name='model' />
                <x-input-text value="{{ old('serial_number') }}" parent-class='col-span-2' label='Serial'
                    name='serial_number' />
                <x-input-text value="{{ old('service_tag') }}" parent-class='col-span-2' label='Tag de Serviço'
                    name='service_tag' />
                <x-textarea value="{{ old('description') }}" label='Descrição' parent-class='col-span-6'></x-textarea>
            </div>
        </div>
    </x-form>
</x-pages.upsert>
