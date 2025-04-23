@php
    $findBrand = function (?int $id = null):string{
        return App\Models\Brand::find($id)?->name ?? '';
    }
@endphp
<x-pages.show :subtitle='$checkin->client->name' backRoute="{{ route('checkins.index') }}" title='Checkin' x-data='{ show: false }'>
    <x-slot:actions>
        <div class="flex gap-x-2">
            <x-button :href="route('budgets.create', $checkin->id)" btn='btn-xs' :disabled="$checkin->budget()->exists()" class='h-8' color=secondary title='Diagnóstico'>
                <x-heroicon-o-wrench-screwdriver class='w-5' />
            </x-button>
            <x-button :href="route('checkins.edit', $checkin->id)" btn='btn-xs' class='h-8' color=secondary title='Editar'>
                <x-heroicon-o-pencil class='w-5' />
            </x-button>
            <x-button @click="show=true" btn='btn-xs' class='h-8' color=secondary title='Remover'>
                <x-heroicon-o-trash class='w-5' />
            </x-button>
        </div>
    </x-slot:actions>

    <div
        class="grid gap-x-4 gap-y-6 lg:grid-cols-6 2xl:grid-cols-3">
        <x-input-text label='Data de Entrada' name='date' parent-class='col-span-2' readonly
            value="{{ $checkin->date->format('d/m/Y') }}" />
        <x-input-text label='Cliente' name='client_id' parent-class='col-span-2' readonly
            value="{{ $checkin->client->name }}" />
        <x-input-text label='Equipamento' name='device_id' parent-class='col-span-2' readonly
            value="{{ $checkin->device->name }}" />
        @if ($checkin->configuration()->exists())
            <x-card
                @class(['border-red-500 border' => $errors->has('configuration')]) label='Configuração'>
                <div class="grid gap-x-4 gap-y-6">
                    <x-input-text label='Sistema Operacional' name='configuration[os]' readonly
                        value="{{ data_get($checkin, 'configuration.os') }}" />
                    <x-form-session
                        class='grid-cols-2' label='Processador' parent-class='col-span-6'>
                        <x-input-text label='Marca' name='configuration[cpu][brand_id]' readonly
                            value="{{ $findBrand(data_get($checkin, 'configuration.cpu.brand_id')) }}" />
                        <x-input-text label='Modelo' name='configuration[cpu][model]' readonly
                            value="{{ data_get($checkin, 'configuration.cpu.model') }}" />
                    </x-form-session>
                    <x-form-session
                        class='grid-cols-2' label='Placa Mãe' parent-class='col-span-6'>
                        <x-input-text label='Marca' name='configuration[mobo][brand_id]' readonly
                            value="{{ $findBrand(data_get($checkin, 'configuration.mobo.brand_id')) }}" />
                        <x-input-text label='Modelo' name='configuration[mobo][model]' readonly
                            value="{{ data_get($checkin, 'configuration.mobo.model') }}" />
                    </x-form-session>
                    <x-form-session
                        class='grid-cols-3' label='Memória Ram' parent-class='col-span-6'>
                        <x-input-text label='Marca' name='configuration[memory][0][brand_id]' readonly
                            value="{{ $findBrand(data_get($checkin, 'configuration.memory.0.brand_id')) }}" />
                        <x-input-text label='Modelo' name='configuration[memory][0][model]' readonly
                            value="{{ data_get($checkin, 'configuration.memory.0.model') }}" />
                        <x-input-text label='Tamanho' name='configuration[memory][0][size]' readonly 
                            value="{{ data_get($checkin, 'configuration.memory.0.size') }}">
                            <x-slot:suffix>GB</x-slot>
                        </x-input-text>
                    </x-form-session>
                    <x-form-session
                        class='grid-cols-3' label='Armazenamento' parent-class='col-span-6'>
                        <x-input-text label='Marca' name='configuration[storage][0][brand_id]' readonly
                            value="{{ $findBrand(data_get($checkin, 'configuration.storage.0.brand_id')) }}" />
                        <x-input-text label='Modelo' name='configuration[storage][0][model]' readonly
                            value="{{ data_get($checkin, 'configuration.storage.0.model') }}" />
                        <x-input-text label='Tamanho' name='configuration[storage][0][size]' readonly 
                            value="{{ data_get($checkin, 'configuration.storage.0.size') }}">
                            <x-slot:suffix>GB</x-slot>
                        </x-input-text>
                    </x-form-session>
                    <x-form-session
                        class='grid-cols-3' label='GPU' parent-class='col-span-6'>
                        <x-input-text label='Marca' name='configuration[gpu][brand_id]' readonly
                            value="{{ $findBrand(data_get($checkin, 'configuration.gpu.brand_id')) }}" />
                        <x-input-text label='Modelo' name='configuration[gpu][model]' readonly
                            value="{{ data_get($checkin, 'configuration.gpu.model') }}" />
                        <x-input-text label='Ram' name='configuration[gpu][ram]' readonly 
                            value="{{ data_get($checkin, 'configuration.gpu.ram') }}">
                            <x-slot:suffix>GB</x-slot>
                        </x-input-text>
                    </x-form-session>
                    <x-form-session
                        class='grid-cols-3' label='Fonte' parent-class='col-span-6'>
                        <x-input-text label='Marca' name='configuration[power_supply][brand_id]' readonly
                            value="{{ $findBrand(data_get($checkin, 'configuration.power_supply.brand_id')) }}" />
                        <x-input-text label='Modelo' name='configuration[power_supply][model]' readonly
                            value="{{ data_get($checkin, 'configuration.power_supply.model') }}" />
                        <x-input-text label='Potência Nominal' name='configuration[power_supply][wattage]' readonly
                            value="{{ data_get($checkin, 'configuration.power_supply.wattage') }}">
                            <x-slot:suffix>Watts</x-slot>
                        </x-input-text>
                    </x-form-session>
                    <x-textarea
                        label='Observações' name='description' parent-class='col-span-6 border-t pt-4'
                        value='{{ old('description') }}' />
                </div>
            </x-card>
        @endif
        <x-textarea label='Relatos' name='description' parent-class='col-span-6' readonly
            value="{{ $checkin->description }}" />
    </div>
    <x-modal id='deleteModal'>
        <form action="{{ route('checkins.destroy', $checkin->id) }}" class="form" method="post">
            @csrf
            @method('DELETE')
            <x-card label="Excluir Orçamento">
                <p>Tem certeza que deseja excluir esse orçamento?</p>
                <x-slot name='footer'>
                    <x-button @click="show = false" color='secondary'>Cancelar</x-button>
                    <x-button type=submit>Excluir</x-button>
                </x-slot>
            </x-card>
        </form>
    </x-modal>
</x-pages.show>
