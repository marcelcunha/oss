<x-pages.upsert title='Editar Marca'>
    <x-form action="{{ route('brands.update', $brand) }}" update cancelRoute="{{ route('brands.index') }}">
        <div class="grid lg:grid-cols-2 2xl:grid-cols-3 gap-x-4 gap-y-6">
            <x-input-text label='Nome' name='name' value="{{ old('name', $brand->name) }}" />
            <x-input-badge sub-label="Digite o que deseja e em seguida: ';' para gerar a categoria" id='categories'
                label='Categorias' name='categories' :items="old('categories', $brand->categories ?? [])" />

        </div>
    </x-form>
</x-pages.upsert>
