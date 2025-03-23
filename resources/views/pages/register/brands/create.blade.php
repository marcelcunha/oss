<x-pages.upsert title='Nova Marca'>
    <x-form action="{{ route('brands.store') }}" cancelRoute="{{ route('brands.index') }}">
        <div class="grid lg:grid-cols-2 2xl:grid-cols-3">
            <x-input-text label='Nome' name='name'/>
        </div>
    </x-form>
</x-pages.upsert>