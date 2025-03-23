<x-pages.upsert title='Novo Tipo de Equipamento'>
    <x-form action="{{ route('device_types.store') }}" cancelRoute="{{ route('device_types.index') }}">
        <div class="grid lg:grid-cols-2 2xl:grid-cols-3">
            <x-input-text label='Nome' name='name'/>
        </div>
    </x-form>
</x-pages.upsert>