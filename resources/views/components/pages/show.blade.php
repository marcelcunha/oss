<x-app-layout>

    <div class="py-4 px-8">
        <!-- actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">{{ $title }}</h1>
            </div>

        </div>
        {{ $slot }}
    </div>
</x-app-layout>
