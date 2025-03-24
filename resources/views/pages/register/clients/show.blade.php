<x-pages.show title='Cliente' :subtitle='$client->name'>
   
        <div class="grid lg:grid-cols-8 2xl:grid-cols-10 gap-x-4 gap-y-6" x-data>
            <x-input-text readonly value="{{ $client?->name }}" label='Nome' name='name' parent-class='lg:col-span-6 2xl:col-span-8' />
            <x-input-text readonly value="{{ $client?->phone }}" label='Telefone' name='phone' parent-class='lg:col-span-2'/>
            <x-input-text readonly value="{{ $client?->address }}" label='Logradouro' name='address' parent-class='lg:col-span-4 2xl:col-span-6' />
            <x-input-text readonly value="{{ $client?->num }}" label='Nº' name='num' max-length='5' />
            <x-input-text readonly value="{{ $client?->complement }}" label='Complemento' name='complement'
                parent-class='lg:col-span-3' />
        </div>
    
</x-pages.show>
