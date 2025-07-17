<x-pages.upsert title='Aprovar Orçamento'>
    <x-form
        action="{{ route('checkins.store') }}" cancelRoute="{{ route('checkins.index') }}" id='budget-form'>
        <div
            class="grid grid-cols-1 md:gap-x-4 gap-y-6 md:grid-cols-6 " x-data="budgetForm()">
            <x-input-text
                label='Data de Entrada' name='date' parent-class='md:col-span-2' required type='date'
                value="{{ old('date') }}" />

           

            <x-select
                ::disabled='devices.length <= 0' label='Equipamento' name='device_id' parent-class='md:col-span-2' required
                value="{{ old('device_id') }}" x-model='device_id'>
                <option selected>Selecione </option>
                <template x-for="device in devices">
                    <option
                        :key="device.id" :value="device.id" x-text="device.description"></option>
                </template>

            </x-select>

           

            <x-textarea
                label='Relatos' parent-class='md:col-span-6' name='description' value="{{ old('description') }}"/>

        </div>
    </x-form>

    
</x-pages.upsert>
