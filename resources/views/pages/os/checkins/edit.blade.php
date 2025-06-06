<x-pages.upsert title='Editar Orçamento'>
    <x-form
        action="{{ route('checkins.update', $checkin) }}" cancelRoute="{{ route('checkins.index') }}" id='budget-form' update>
        <div
            class="grid grid-cols-1 gap-y-6 lg:grid-cols-6 lg:gap-x-4 2xl:grid-cols-3" x-data="budgetForm()">
            <x-input-text
                label='Data de Entrada' name='date' parent-class='lg:col-span-2' required type='date'
                value="{{ old('date', $checkin->date->format('Y-m-d')) }}" />

            <x-select
                :disabled="empty($clients)" :options="$clients" label='Cliente' name='client_id' parent-class='lg:col-span-2'
                required value="{{ old('client_id', $checkin->client_id) }}" x-model='client' />

            <x-select
                ::disabled='devices.length <= 0' label='Equipamento' name='device_id' parent-class='lg:col-span-2' required
                value="{{ old('device_id', $checkin->device_id) }}" x-model='device_id'>
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
                            value="{{ old('configuration.os', $checkin->configuration?->os) }}" />

                        <x-form-session
                            class='grid-cols-2' label='Processador' parent-class='lg:col-span-6'>
                            <x-select
                                :options="$cpuBrands" label='Marca' name='configuration[cpu][brand_id]' required
                                value="{{ old('configuration.cpu.brand_id', $checkin->configuration?->cpu['brand_id']) }}" />
                            <x-input-text
                                label='Modelo' name='configuration[cpu][model]' required
                                value="{{ old('configuration.cpu.model', $checkin->configuration?->cpu['model']) }}" />
                        </x-form-session>

                        <x-form-session
                            class='grid-cols-2' label='Placa Mãe' parent-class='lg:col-span-6'>
                            <x-select
                                :options="$moboBrands" label='Marca' name='configuration[mobo][brand_id]'
                                value="{{ old('configuration.mobo.brand_id', data_get($checkin->configuration, 'mobo.brand_id')) }}" />
                            <x-input-text
                                label='Modelo' name='configuration[mobo][model]'
                                value="{{ old('configuration.mobo.model', data_get($checkin->configuration, 'mobo.model')) }}" />
                        </x-form-session>

                        <x-form-session
                            class='grid-cols-3' label='Memória Ram' parent-class='lg:col-span-6'>
                            <x-select
                                :options="$ramBrands" label='Marca' name='configuration[memory][0][brand_id]'
                                value="{{ old('configuration.memory.0.brand_id', data_get($checkin->configuration, 'memory.0.brand_id')) }}" />
                            <x-input-text
                                label='Modelo' name='configuration[memory][0][model]'
                                value="{{ old('configuration.memory.0.model', data_get($checkin->configuration, 'memory.0.model')) }}" />
                            <x-input-text
                                label='Tamanho' name='configuration[memory][0][size]' type='number'
                                value="{{ old('configuration.memory.0.size', data_get($checkin->configuration, 'memory.0.size')) }}">
                                <x-slot:suffix>GB</x-slot>
                            </x-input-text>
                        </x-form-session>

                        <x-form-session
                            class='grid-cols-3' label='Armazenamento' parent-class='lg:col-span-6'>
                            <x-select
                                :options="$storageBrands" label='Marca' name='configuration[storage][0][brand_id]'
                                value="{{ old('configuration.storage.0.brand_id', data_get($checkin->configuration, 'storage.0.brand_id')) }}" />
                            <x-input-text
                                label='Modelo' name='configuration[storage][0][model]'
                                value="{{ old('configuration.storage.0.model', data_get($checkin->configuration, 'storage.0.model')) }}" />
                            <x-input-text
                                label='Tamanho' name='configuration[storage][0][size]' type='number'
                                value="{{ old('configuration.storage.0.size', data_get($checkin->configuration, 'storage.0.size')) }}">
                                <x-slot:suffix>GB</x-slot>
                            </x-input-text>
                        </x-form-session>

                        <x-form-session
                            class='grid-cols-3' label='GPU' parent-class='lg:col-span-6'>
                            <x-select
                                :options="$gpuBrands" label='Marca' name='configuration[gpu][brand_id]'
                                value="{{ old('configuration.gpu.brand_id', data_get($checkin->configuration, 'gpu.brand_id')) }}" />
                            <x-input-text
                                label='Modelo' name='configuration[gpu][model]'
                                value="{{ old('configuration.gpu.model', data_get($checkin->configuration, 'gpu.model')) }}" />
                            <x-input-text
                                label='Ram' name='configuration[gpu][ram]' type='number'
                                value="{{ old('configuration.gpu.ram', data_get($checkin->configuration, 'gpu.ram')) }}">
                                <x-slot:suffix>GB</x-slot>
                            </x-input-text>
                        </x-form-session>

                        <x-form-session
                            class='grid-cols-3' label='Fonte' parent-class='lg:col-span-6'>
                            <x-select
                                :options="$psuplyBrands" label='Marca' name='configuration[power_supply][brand_id]'
                                value="{{ old('configuration.power_supply.brand_id', data_get($checkin->configuration, 'power_supply.brand_id')) }}" />
                            <x-input-text
                                label='Modelo' name='configuration[power_supply][model]'
                                value="{{ old('configuration.power_supply.model', data_get($checkin->configuration, 'power_supply.model')) }}" />
                            <x-input-text
                                label='Potência Nominal' name='configuration[power_supply][wattage]'
                                value="{{ old('configuration.power_supply.wattage', data_get($checkin->configuration, 'power_supply.wattage')) }}">
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
                label='Relatos' name='description' parent-class='lg:col-span-6' value="{{ old('description', $checkin->description) }}" />

        </div>
    </x-form>

    @section('js')
        @parent
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('budgetForm', () => ({
                    acceptableTypes: @json($acceptableTypes),
                    client: @json(old('client_id', $checkin->client_id)),
                    device_id: null,
                    deviceResource: null,
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
                            this.device_id = @json(old('device_id', $checkin->device_id));
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
