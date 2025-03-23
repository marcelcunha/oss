<li
    class="bg-linear-to-r @if (in_array(Request::segment(1), ['dashboard'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif mb-0.5 rounded-lg py-2 pl-4 pr-3 last:mb-0"
    x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }"
>
    <a
        class="@if (!in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif block truncate text-gray-800 transition dark:text-gray-100"
        href="#0"
        @click.prevent="open = !open; sidebarExpanded = true"
    >
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg
                    class="@if (in_array(Request::segment(1), ['dashboard'])) {{ 'text-violet-500' }}@else{{ 'text-gray-400 dark:text-gray-500' }} @endif shrink-0 fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M5.936.278A7.983 7.983 0 0 1 8 0a8 8 0 1 1-8 8c0-.722.104-1.413.278-2.064a1 1 0 1 1 1.932.516A5.99 5.99 0 0 0 2 8a6 6 0 1 0 6-6c-.53 0-1.045.076-1.548.21A1 1 0 1 1 5.936.278Z"
                    />
                    <path
                        d="M6.068 7.482A2.003 2.003 0 0 0 8 10a2 2 0 1 0-.518-3.932L3.707 2.293a1 1 0 0 0-1.414 1.414l3.775 3.775Z"
                    />
                </svg>
                <span
                    class="lg:sidebar-expanded:opacity-100 ml-4 text-sm font-medium duration-200 lg:opacity-0 2xl:opacity-100"
                >Dashboard</span>
            </div>
            <!-- Icon -->
            <div class="lg:sidebar-expanded:opacity-100 ml-2 flex shrink-0 duration-200 lg:opacity-0 2xl:opacity-100">
                <svg
                    class="@if (in_array(Request::segment(1), ['dashboard'])) {{ 'rotate-180' }} @endif ml-1 h-3 w-3 shrink-0 fill-current text-gray-400 dark:text-gray-500"
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
            class="@if (!in_array(Request::segment(1), ['dashboard'])) {{ 'hidden' }} @endif mt-1 pl-8"
            :class="open ? 'block!' : 'hidden'"
        >
            <li class="mb-1 last:mb-0">
                <a
                    class="@if (Route::is('dashboard')) {{ 'text-violet-500!' }} @endif block truncate text-gray-500/90 transition hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    href="{{ route('dashboard') }}"
                >
                    <span
                        class="lg:sidebar-expanded:opacity-100 text-sm font-medium duration-200 lg:opacity-0 2xl:opacity-100"
                    >Main</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a
                    class="@if (Route::is('analytics')) {{ 'text-violet-500!' }} @endif block truncate text-gray-500/90 transition hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    href="{{ route('analytics') }}"
                >
                    <span
                        class="lg:sidebar-expanded:opacity-100 text-sm font-medium duration-200 lg:opacity-0 2xl:opacity-100"
                    >Analytics</span>
                </a>
            </li>
            <li class="mb-1 last:mb-0">
                <a
                    class="@if (Route::is('fintech')) {{ 'text-violet-500!' }} @endif block truncate text-gray-500/90 transition hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    href="{{ route('fintech') }}"
                >
                    <span
                        class="lg:sidebar-expanded:opacity-100 text-sm font-medium duration-200 lg:opacity-0 2xl:opacity-100"
                    >Fintech</span>
                </a>
            </li>
        </ul>
    </div>
</li>
