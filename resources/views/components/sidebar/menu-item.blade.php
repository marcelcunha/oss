<li class="mb-1 last:mb-0">
    <a
        class="@if (Route::is($route)) {{ 'text-violet-500!' }} @endif block truncate text-gray-500/90 transition hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
        href="{{ route( $route ) }}"
    >
        <span
            class="lg:sidebar-expanded:opacity-100 text-sm font-medium duration-200 lg:opacity-0 2xl:opacity-100"
        >{{$label}}</span>
    </a>
</li>