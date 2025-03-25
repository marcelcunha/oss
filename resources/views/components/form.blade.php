@props(['submitButton' => 'Salvar', 'action', 'cancelRoute','update' => false])
<form action="{{ $action }}" method="post">
    <x-card>
        @csrf
        @if ($update)
            @method('PUT')
        @endif

        {{ $slot }}
        <x-slot name='footer'>
            <div class="flex gap-2 justify-end">
                @if (isset($actionButtons))
                    {{ $actionButtons }}
                @else
                    <x-button :href="$cancelRoute"
                        color='secondary'>
                        Cancelar
                    </x-button>
                    <x-button type='submit'>
                        {{ $submitButton }}
                    </x-button>
                @endif
            </div>
        </x-slot>
    </x-card>
</form>
