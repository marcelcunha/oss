<x-app-layout>
    <div class="max-w-9xl mx-auto w-full px-4 py-8 sm:px-6 lg:px-8">

        <!-- Dashboard actions -->
        <div class="mb-8 sm:flex sm:items-center sm:justify-between">

            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-gray-100">Dashboard</h1>
            </div>

            <!-- Right: Actions -->
            {{-- <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

                <!-- Filter button -->
                <x-dropdown-filter align="right" />

                <!-- Datepicker built with flatpickr -->
                <x-datepicker />

                <!-- Add view button -->
                <button class="btn bg-gray-900 text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="fill-current shrink-0 xs:hidden" width="16" height="16" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                  </svg>
                  <span class="max-xs:sr-only">Add View</span>
                </button>
                
            </div> --}}

        </div>

        <!-- Cards -->
        <div>
            <h3 class="text-base font-semibold text-gray-900">Última Semana</h3>

            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($data as $item)
                    <x-stats :icon='$item->icon' :label='$item->label' :value='$item->total' />
                @endforeach
                {{-- <x-stats value='0' icon='wrench-screwdriver' label='Orçamentos Pendentes'/> --}}
                {{-- <x-stats value='0' icon='wrench-screwdriver' label='Orçamentos Concluídos'/> --}}
            </dl>
        </div>

    </div>
</x-app-layout>
