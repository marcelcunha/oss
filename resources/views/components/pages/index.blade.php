@php
    $types = collect(['success', 'error', 'warning', 'info']);

    $type = $types->first(fn($type) => session()->has($type));
@endphp
<x-app-layout>

    <div class="px-8 py-4">
        <!-- actions -->
        <div class="mb-8 sm:flex sm:items-center sm:justify-between">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-gray-100">{{ $title }}</h1>
            </div>

            <!-- Right: Actions -->
            <div class="grid grid-flow-col justify-start gap-2 sm:auto-cols-max sm:justify-end">
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
