<x-pages.upsert title='Novo Checkin'>
    <x-form
        action="{{ route('checkins.store') }}" cancelRoute="{{ route('checkins.index') }}" id='budget-form'>
        <div
            class="grid grid-cols-1 md:gap-x-4 gap-y-6 md:grid-cols-6 " x-data="budgetForm()">
            <x-input-text
                label='Data de Entrada' name='date' parent-class='md:col-span-2' required type='date'
                value="{{ old('date') }}" />

            <x-select
                :disabled="empty($clients)" :options="$clients" label='Cliente' name='client_id' parent-class='md:col-span-2' required
                value="{{ old('client_id') }}" x-model='client' />

            <x-select
                ::disabled='devices.length <= 0' label='Equipamento' name='device_id' parent-class='md:col-span-2' required
                value="{{ old('device_id') }}" x-model='device_id'>
                <option selected>Selecione </option>
                <template x-for="device in devices">
                    <option
                        :key="device.id" :value="device.id" x-text="device.description"></option>
                </template>

            </x-select>

            <template x-if="deviceResource && acceptableTypes.includes(deviceResource.type)">
                <x-card
                    @class(['border-red-500 border' => $errors->has('configuration')]) label='Configuração'>

                    <div class="grid gap-x-4 gap-y-6">
                        <x-input-text
                            label='Sistema Operacional' name='configuration[os]' required
                            value="{{ old('configuration.os') }}" />

                        <x-form-session
                            class='md:grid-cols-2 gap-y-6 ' label='Processador' parent-class='md:col-span-6'>
                            <x-select
                                :options="$cpuBrands" label='Marca' name='configuration[cpu][brand_id]' required
                                value="{{ old('configuration.cpu.brand_id') }}" />
                            <x-input-text
                                label='Modelo' name='configuration[cpu][model]' required
                                value="{{ old('configuration.cpu.model') }}" />
                        </x-form-session>

                        <x-form-session
                            class='md:grid-cols-2 gap-y-6' label='Placa Mãe' parent-class='md:col-span-6'>
                            <x-select
                                :options="$moboBrands" label='Marca' name='configuration[mobo][brand_id]'
                                value="{{ old('configuration.mobo.brand_id') }}" />
                            <x-input-text
                                label='Modelo' name='configuration[mobo][model]'
                                value="{{ old('configuration.mobo.model') }}" />
                        </x-form-session>

                        <x-form-session
                            class='md:grid-cols-3 gap-y-6' label='Memória Ram' parent-class='md:col-span-6'>
                            <x-select
                                :options="$ramBrands" label='Marca' name='configuration[memory][0][brand_id]'
                                value="{{ old('configuration.memory.0.brand_id') }}" />
                            <x-input-text
                                label='Modelo' name='configuration[memory][0][model]'
                                value="{{ old('configuration.memory.0.model') }}" />
                            <x-input-text
                                label='Tamanho' name='configuration[memory][0][size]'
                                value="{{ old('configuration.memory.0.size') }}" type='number'>
                                <x-slot:suffix>GB</x-slot>
                            </x-input-text>
                        </x-form-session>

                        <x-form-session
                            class='md:grid-cols-3 gap-y-6' label='Armazenamento' parent-class='md:col-span-6'>
                            <x-select
                                :options="$storageBrands" label='Marca' name='configuration[storage][0][brand_id]'
                                value="{{ old('configuration.storage.0.brand_id') }}" />
                            <x-input-text
                                label='Modelo' name='configuration[storage][0][model]'
                                value="{{ old('configuration.storage.0.model') }}" />
                            <x-input-text
                                label='Tamanho' name='configuration[storage][0][size]'
                                value="{{ old('configuration.storage.0.size') }}" type='number'>
                                <x-slot:suffix>GB</x-slot>
                            </x-input-text>
                        </x-form-session>

                        <x-form-session
                            class='md:grid-cols-3 gap-y-6' label='GPU' parent-class='md:col-span-6'>
                            <x-select
                                :options="$gpuBrands" label='Marca' name='configuration[gpu][brand_id]'
                                value="{{ old('configuration.gpu.brand_id') }}" />
                            <x-input-text
                                label='Modelo' name='configuration[gpu][model]'
                                value="{{ old('configuration.gpu.model') }}" />
                            <x-input-text
                                label='Ram' name='configuration[gpu][ram]'
                                value="{{ old('configuration.gpu.ram') }}" type='number'>
                                <x-slot:suffix>GB</x-slot>
                            </x-input-text>
                        </x-form-session>

                        <x-form-session
                            class='md:grid-cols-3 gap-y-6' label='Fonte' parent-class='md:col-span-6'>
                            <x-select
                                :options="$psuplyBrands" label='Marca' name='configuration[power_supply][brand_id]'
                                value="{{ old('configuration.power_supply.brand_id') }}" />
                            <x-input-text
                                label='Modelo' name='configuration[power_supply][model]'
                                value="{{ old('configuration.power_supply.model') }}" />
                            <x-input-text
                                label='Potência Nominal' name='configuration[power_supply][wattage]'
                                value="{{ old('configuration.power_supply.wattage') }}" type='number'>
                                <x-slot:suffix>Watts</x-slot>
                            </x-input-text>
                        </x-form-session>

                        <x-textarea
                            label='Observações' name='description' parent-class='col-span-6 border-t pt-4'
                            value='{{ old('description') }}' />
                    </div>

                </x-card>
            </template>

            <x-textarea
                label='Relatos' parent-class='md:col-span-6' name='description' value="{{ old('description') }}"/>

        </div>
    </x-form>

    @section('js')
        @parent
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('budgetForm', () => ({
                    acceptableTypes: @json($acceptableTypes),
                    client: @json(old('client_id', null)),
                    device_id: null,
                    deviceResource: {type: 'desktop'},
                    devices: [],
                    async fillDevices() {
                        try {
                            const response = await axios.get('/api/devices', {
                                params: {
                                    client_id: this.client
                                }
                            });
                            this.devices = response.data.data;

                            // Define o device_id antigo depois de carregar as opções
                            this.device_id = @json(old('device_id', null));
                        } catch (error) {
                            console.error(error);
                        }
                    },
                    async fillDeviceResource() {
                        try {
                            const response = await axios.get(`/api/device/${this.device_id}`);
                            this.deviceResource = response.data.data;
                        } catch (error) {
                            console.error(error);
                        }
                    },
                    async init() {
                        if (this.client) {
                            await this.fillDevices();
                            await this.fillDeviceResource();
                        };

                        this.$watch('client', async (value) => {
                            if (value) {
                                await this.fillDevices();
                            } else {
                                this.devices = [];
                            }
                        });
                        this.$watch('device_id', async (value) => {
                            if (value) {
                                await this.fillDeviceResource();
                            } else {
                                this.deviceResource = null;
                            }
                        });
                    }

                }));
            });
        </script>
    @endsection
</x-pages.upsert>
