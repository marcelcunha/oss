@php
// session()->put('success', 'This is a success message');
    $types = collect(['success', 'danger', 'warning', 'info']);
    
    $type = $types->first(fn( $type) => session()->has($type));
    @endphp
<x-app-layout>

    <div class="py-4 px-8">
        <!-- actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">{{ $title }}</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
                @if (isset($actions))
                    {{ $actions }}
                @endif

            </div>

        </div>
        {{ $slot }}

    </div>
    @if ($type)
    <x-action-message :type="$type">
        {{ session()->get($type) }}
    </x-action-message>
    @endif
</x-app-layout>
