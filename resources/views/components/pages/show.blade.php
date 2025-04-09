<x-app-layout>

    <div class="px-8 py-4" {{ $attributes->merge(['class' => '']) }}>
        <!-- actions -->
        <div class="mb-8 sm:flex sm:items-center sm:justify-between">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-gray-100">{{ $title }}</h1>
                @isset($subtitle)
                    <h3 class="text-lg font-bold text-gray-800 md:pl-10 md:text-xl dark:text-gray-100">
                        {{ $subtitle }}
                    </h3>
                @endisset

            </div>
            <!-- Right: Actions -->
            @isset($actions)
                {{ $actions }}
            @endisset

        </div>
        <x-card>
            {{ $slot }}

            <x-slot:footer>
                <div class='flex justify-end'>
                    <x-button :href="$backRoute">
                        Voltar
                    </x-button>

                </div>
            </x-slot>
        </x-card>
    </div>
</x-app-layout>
