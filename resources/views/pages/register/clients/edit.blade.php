<x-pages.upsert title='Editar Cliente'>
    <x-form action="{{ route('clients.update', $client->id) }}" cancelRoute="{{ route('clients.index') }}" update>
        <div class="grid lg:grid-cols-8 2xl:grid-cols-10 gap-x-4 gap-y-6" x-data>
            <x-input-text value="{{ old('name',$client?->name) }}" label='Nome' name='name' parent-class='lg:col-span-6 2xl:col-span-8' />
            <x-input-text value="{{ old('phone',$client?->phone) }}" label='Telefone' name='phone' parent-class='lg:col-span-2'
                x-mask='(99) 9 9999-9999' />
            <x-input-text value="{{ old('address',$client?->address) }}" label='Logradouro' name='address' parent-class='lg:col-span-4 2xl:col-span-6' />
            <x-input-text value="{{ old('num',$client?->num) }}" label='Nº' name='num' max-length='5' x-mask='99999'/>
            <x-input-text value="{{ old('complement',$client?->complement) }}" label='Complemento' name='complement'
                parent-class='lg:col-span-3' />
        </div>
    </x-form>
</x-pages.upsert>
