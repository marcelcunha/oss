<x-pages.upsert title='Editar Marca'>
    <x-form action="{{ route('brands.update', $brand) }}" update cancelRoute="{{ route('brands.index') }}">
        <div class="grid lg:grid-cols-2 2xl:grid-cols-3">
            <x-input-text label='Nome' name='name' value="{{ old('name', $brand?->name) }}"/>
        </div>
    </x-form>
</x-pages.upsert>