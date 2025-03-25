<div
    {{ $attributes->merge(['class' => 'col-span-full xl:col-span-8 bg-white dark:bg-gray-800 shadow-xs rounded-xl']) }}>
    @if (isset($label))
        <header class="px-5 py-4  border-b border-b-gray-100 dark:border-gray-700/60">
            <h2 class="font-semibold text-gray-800 dark:text-gray-100">{{ $label }}</h2>
        </header>
    @endif
    <div class="p-3">
        {{ $slot }}

    </div>
    @if (isset($footer))
        <footer class="px-5 py-4 border-t border-gray-100 dark:border-gray-700/60">
            {{ $footer }}
        </footer>
    @endif
</div>
