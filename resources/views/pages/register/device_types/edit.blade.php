<x-pages.upsert title='Editar Marca'>
    <x-form action="{{ route('device_types.update', $type) }}" update cancelRoute="{{ route('device_types.index') }}">
        <div class="grid lg:grid-cols-2 2xl:grid-cols-3">
            <x-input-text label='Nome' name='name' value="{{ old('name', $type?->name) }}"/>
        </div>
    </x-form>
</x-pages.upsert>