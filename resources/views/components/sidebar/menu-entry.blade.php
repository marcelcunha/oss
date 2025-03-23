<li
    class="bg-linear-to-r @if (in_array(Request::segment(1), [$routePrefix])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif mb-0.5 rounded-lg py-2 pl-4 pr-3 last:mb-0"
    x-data="{ open: {{ in_array(Request::segment(1), [$routePrefix]) ? 1 : 0 }} }"
>
    <a
        class="@if (!in_array(Request::segment(1), [$routePrefix])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif block truncate text-gray-800 transition dark:text-gray-100"
        href="#0"
        @click.prevent="open = !open; sidebarExpanded = true"
    >
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <x-heroicon-o-arrow-left/>
                <span
                    class="lg:sidebar-expanded:opacity-100 ml-4 text-sm font-medium duration-200 lg:opacity-0 2xl:opacity-100"
                >{{$label}}</span>
            </div>
            <!-- Icon -->
            <div class="lg:sidebar-expanded:opacity-100 ml-2 flex shrink-0 duration-200 lg:opacity-0 2xl:opacity-100">
                <svg
                    class="@if (in_array(Request::segment(1), [$routePrefix])) {{ 'rotate-180' }} @endif ml-1 h-3 w-3 shrink-0 fill-current text-gray-400 dark:text-gray-500"
                    :class="open ? 'rotate-180' : 'rotate-0'"
                    viewBox="0 0 12 12"
                >
                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                </svg>
            </div>
        </div>
    </a>
    <div class="lg:sidebar-expanded:block lg:hidden 2xl:block">
        <ul
            class="@if (!in_array(Request::segment(1), [$routePrefix])) {{ 'hidden' }} @endif mt-1 pl-8"
            :class="open ? 'block!' : 'hidden'"
        >
          {{ $slot }}
        </ul>
    </div>
</li>
